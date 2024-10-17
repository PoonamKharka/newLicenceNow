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
            })->select('*')->orderBy('created_at', 'DESC');

            return datatables()->of($instrutors)
                ->addColumn('userStatus', function ($row) {
                    if ($row->status == 1) {
                        return '<h5><span class="badge badge-success">Active</a></h5>';
                    } else {
                        return '<h5><span class="badge badge-success">Inactive</a></h5>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('instructors.show', encrypt($row->id)) . '" class="btn btn-sm btn-success">
                        <i class="fas fa-plus"></i>
                        <span>More Details</span></a>';
                    $btn .= '&nbsp';
                    $btn .= '<a href="' . route('users.show', encrypt($row->id)) . '" class="btn btn-sm btn-info">
                        <i class="fas fa-pencil-alt"></i>
                        <span>Update Cred</span></a>';

                    return $btn;
                })
                ->addColumn('username', function ($row) {
                    $name = $row->first_name . ' ' . $row->last_name;

                    return $name;
                })
                ->rawColumns(['action' , 'username', 'userStatus'])
                ->make(true);
        }
        return view('admin.instructor.index');
    }

    public function profile($id)
    {
        $userId = decrypt($id);
        $userData =  User::with('bankDetails', 'profileDetails' , 'instructorVehicle','instructorLocations','instructorPrices')->findOrFail($userId);        
        if ($userData->profileDetails) {
            $userData->profileDetails->dob = Carbon::parse($userData->profileDetails->dob)->format('d/m/Y');
            $userData->profileDetails->doj = Carbon::parse($userData->profileDetails->doj)->format('d/m/Y');
            $userData->profileDetails->dot = Carbon::parse($userData->profileDetails->dot)->format('d/m/Y');
        }
        
        return $userData;
    }

    public function store(Request $request)
    {
        $user = InstructorProfileDetail::where('user_id', '=' , $request->user_id)->first();
        
        return $user;
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
    public function validatePhone($myRequest)
    {
        $phoneNo = $myRequest->input('phoneNo');
        $originalPhoneNo = $myRequest->input('existing_phoneNo');  
       
        
        if(empty($originalPhoneNo))
        {
            $exists=0;
            return response()->json(!$exists, $exists ? 200 : 200);
        }
        $exists = InstructorProfileDetail::where('phoneNo', $phoneNo)
        ->where('phoneNo', '!=', $originalPhoneNo) 
        ->exists();
     
        return response()->json(!$exists, $exists ? 200 : 200);
    }
    
    public function validateSalaryPayModeId(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'salaryPayModeId' => 'required|exists:salary_pay_modes,id',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
    

        return true;
    }
}