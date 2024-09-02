<?php

namespace App\Repositories\Repository;

use App\Models\User;
use Mockery\Instantiator;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\InstructorBankDetail;
use App\Models\InstructorProfileDetail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Repositories\InterFaces\InstructorRepositoryInterFace;

class InstructorRepository implements InstructorRepositoryInterFace
{

    public function getAllInstructors(Request $request)
    {

        if ($request->ajax()) {
            $instrutors = User::whereHas('userType', function ($query) {
                $query->where('type', '=', 'Instructor');
            })->select('*');

            return datatables()->of($instrutors)
                ->editColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return 'Active';
                    } else {
                        return 'Inactive';
                    }
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('instructors.show', encrypt($row)) . '" class="btn btn-sm btn-success">
                        <i class="fas fa-plus"></i>
                        <span>More Details</span></a>';
                    $btn .= '&nbsp';
                    $btn .= '<a href="' . route('users.show', encrypt($row->id)) . '" class="btn btn-sm btn-info">
                        <i class="fas fa-pencil-alt"></i>
                        <span>Update Cred</span></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.instructor.index');
    }

    public function profile($request, $data)
    {
        $users = decrypt($data);
        $userData =  User::with('bankDetails', 'profileDetails')->findOrFail($users->id);
        if( $userData->profileDetails ){
            $userData->profileDetails->dob = Carbon::parse($userData->profileDetails->dob)->format('d/m/Y');
            $userData->profileDetails->doj = Carbon::parse($userData->profileDetails->doj)->format('d/m/Y');
            $userData->profileDetails->dot = Carbon::parse($userData->profileDetails->dot)->format('d/m/Y');
        }
        
        return view('admin.instructor.profile', compact('userData'));
    }

    public function store(Request $request)
    {
        // Determine which form was submitted
        $formType = $request->input('form_type');

        if ( $formType === 'personal_details' ) {
            // Logic for processing the Personal Details form

            // Convert dates from d/m/Y to Y-m-d using Carbon
            $dob = Carbon::createFromFormat('d/m/Y', $request->input('dob'))->format('Y-m-d');
            $doj = Carbon::createFromFormat('d/m/Y', $request->input('doj'))->format('Y-m-d');
            $dot = $request->input('dot') ? Carbon::createFromFormat('d/m/Y', $request->input('dot'))->format('Y-m-d') : null;

            // Create and save the InstructorProfileDetail instance
            $instructorProfileDetail = new InstructorProfileDetail();

            // Handle picture upload
            if ($request->hasFile('picture')) {
                $imageFileName = time() . '_image.' . $request->file('picture')->getClientOriginalExtension();
                $request->file('picture')->move(public_path('profile'), $imageFileName);
                $instructorProfileDetail->picture = 'profile/' . $imageFileName;
            }
            
            //Assign other input data to the model
            $instructorProfileDetail = [
                'user_id' => $request->input('user_id'),
                'phoneNo' => $request->input('phoneNo'),
                'contact_address' => $request->input('contactAddress'),
                'dob' => $dob,
                'doj' => $doj,
                'dot' => $dot,
                'blood_group_id' => $request->input('bloodGroupId'),
                'driving_expirence' => $request->input('drivingExpirence'),
                'gender_id' => $request->input('genderId'),
            ];

            // Save the instance to the database
            $findUser = InstructorProfileDetail::where('user_id', '=' , $request->input('user_id'))->first();
            
                if( $findUser ){
                    $updateDetails =  $findUser->update($instructorProfileDetail);
                } else {
                    $updateDetails =  InstructorProfileDetail::create($instructorProfileDetail);
                }
            if( $updateDetails ) {
                return back()->with('success', 'Data has been added!');
            }
            
        } elseif ($formType === 'bank_details') {
            
            $instructorBankDetail = [
                'user_id' => $request->input('user_id'),
                'salary_pay_mode_id' => $request->input('salaryPayModeId'),
                'salary_bank_name' => $request->input('salaryBankName'),
                'salary_branch_name' => $request->input('salaryBranchName'),
                'salary_ifsc_code' => $request->input('salaryIFSCCode'),
                'salary_account_number' => $request->input('salaryAccountNumber'),
            ];
            
            $findBankDetails = InstructorBankDetail::where('user_id', $request->input('user_id'))->first();
            
            if( $findBankDetails ){
                $updateBankDetails =  $findBankDetails->update($instructorBankDetail);
            } else {
                $updateBankDetails =  InstructorBankDetail::create($instructorBankDetail);
            }
            if( $updateBankDetails ) {
                return back()->with('success', 'Data has been added!');
            }
        }
    }

    public function view($id)
    {
        $userId = decrypt($id);
        return  User::with('bankDetails', 'profileDetails')->findOrFail($userId);
    }

    public function updateData(Request $request, $id)
    {
        $formType = $request->input('form_type');
        $userId = $id; // Decrypt the user ID if necessary

        // Log the request data for debugging
        Log::info('Form Type: ' . $formType);
        Log::info('User ID: ' . $userId);
        Log::info('Request Data: ', $request->all());

        if ($formType === 'personal_details') {
            $dob = $request->input('dob') ? Carbon::createFromFormat('d/m/Y', $request->input('dob'))->format('Y-m-d') : null;
            $doj = $request->input('doj') ? Carbon::createFromFormat('d/m/Y', $request->input('doj'))->format('Y-m-d') : null;
            $dot = $request->input('dot') ? Carbon::createFromFormat('d/m/Y', $request->input('dot'))->format('Y-m-d') : null;

            $instructorProfileDetail = InstructorProfileDetail::where('user_id', $userId)->firstOrFail();

            if ($request->hasFile('picture')) {
                $imageFileName = time() . '_image.' . $request->file('picture')->getClientOriginalExtension();
                $request->file('picture')->move(public_path('profile'), $imageFileName);
                $instructorProfileDetail->picture = 'profile/' . $imageFileName;
            }

            $instructorProfileDetail->update([
                'phoneNo' => $request->input('phoneNo'),
                'contact_address' => $request->input('contactAddress'),
                'postal_code' => $request->input('postalCode') ?: '000000',
                'state' => $request->input('state'),
                'dob' => $dob,
                'doj' => $doj,
                'dot' => $dot,
                'blood_group_id' => $request->input('bloodGroupId'),
                'driving_expirence' => $request->input('drivingExpirence'),
                'gender_id' => $request->input('genderId'),
            ]);

            return redirect()->route('instructors.index')
                ->with('success', 'Instructor profile updated successfully.');
        } elseif ($formType === 'bank_details') {
            $instructorBankDetail = InstructorBankDetail::where('user_id', $userId)->firstOrFail();

            $instructorBankDetail->update([
                'salary_pay_mode_id' => $request->input('salaryPayModeId'),
                'salary_bank_name' => $request->input('salaryBankName'),
                'salary_branch_name' => $request->input('salaryBranchName'),
                'salary_ifsc_code' => $request->input('salaryIFSCCode'),
                'salary_account_number' => $request->input('salaryAccountNumber'),
                'postal_code' => $request->input('postalCode') ?: '000000',
                'state' => $request->input('state'),
            ]);

            return redirect()->route('instructors.index')
                ->with('success', 'Instructor Bank profile updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Invalid form type.');
        }

        return redirect()->back()->with('error', 'Failed to update details.');
    }
}
