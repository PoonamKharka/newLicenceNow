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
        if ($userData->profileDetails) {
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

        if ($formType === 'personal_details') {
            // Logic for processing the Personal Details form

            // Convert dates from d/m/Y to Y-m-d using Carbon
            $dob = Carbon::createFromFormat('d/m/Y', $request->input('dob'))->format('Y-m-d');
            $doj = Carbon::createFromFormat('d/m/Y', $request->input('doj'))->format('Y-m-d');
            $dot = $request->input('dot') ? Carbon::createFromFormat('d/m/Y', $request->input('dot'))->format('Y-m-d') : null;

            // Create and save the InstructorProfileDetail instance
            $instructorProfileDetail = new InstructorProfileDetail();

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

            // Handle picture upload
            if ($request->hasFile('picture')) {
                $imageFileName = time() . '_image.' . $request->file('picture')->getClientOriginalExtension();
                $request->file('picture')->move(public_path('profile'), $imageFileName);
                $instructorProfileDetail['picture'] = 'profile/' . $imageFileName;
            }

            // Save the instance to the database
            $findUser = InstructorProfileDetail::where('user_id', '=', $request->input('user_id'))->first();

            if ($findUser) {
                $updateDetails =  $findUser->update($instructorProfileDetail);
            } else {
                $updateDetails =  InstructorProfileDetail::create($instructorProfileDetail);
            }
            if ($updateDetails) {
                return back()->with('success', 'Data has been added!');
            }
        } elseif ($formType === 'bank_details') {
            // Logic for processing the Bank Details form

            // Prepare the data as an associative array
            $instructorBankDetail = [
                'user_id' => $request->input('user_id'),
                'salary_pay_mode_id' => $request->input('salaryPayModeId'),
                'salary_bank_name' => $request->input('salaryBankName'),
                'salary_branch_name' => $request->input('salaryBranchName'),
                'salary_ifsc_code' => $request->input('salaryIFSCCode'),
                'salary_account_number' => $request->input('salaryAccountNumber'),
            ];

            // Check if the record exists
            $findUser = InstructorBankDetail::where('user_id', '=', $request->input('user_id'))->first();

            if ($findUser) {
                // Update the existing record
                $updateDetails = $findUser->update($instructorBankDetail);
            } else {
                // Create a new record
                $updateDetails = InstructorBankDetail::create($instructorBankDetail);
            }

            if ($updateDetails) {
                // Redirect with success message
                return redirect()->route('instructors.index')->with('success', 'Instructor bank details saved successfully.');
            } else {
                // Handle failure (if needed)
                return back()->with('error', 'Failed to save instructor bank details.');
            }
        }
    }
}
