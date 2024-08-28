<?php

namespace App\Repositories\Repository;

use App\Models\User;
use Mockery\Instantiator;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
                    $btn = '<a href="' . route('instructors.show', encrypt($row)) . '" class="btn btn-sm btn-info">Add More Details</a>';

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
        //dd($users );
        return view('admin.instructor.profile', compact('users'));
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
    
            // Handle picture upload
            if ($request->hasFile('picture')) {
                $imageFileName = time() . '_image.' . $request->file('picture')->getClientOriginalExtension();
                $request->file('picture')->move(public_path('profile'), $imageFileName);
                $instructorProfileDetail->picture = 'profile/' . $imageFileName;
            }
    
            // Assign other input data to the model
            $instructorProfileDetail->user_id = $request->input('user_id');
            $instructorProfileDetail->phoneNo = $request->input('phoneNo');
            $instructorProfileDetail->contact_address = $request->input('contactAddress');
            $instructorProfileDetail->postal_code = $request->input('postalCode') ?: '000000';
            $instructorProfileDetail->state = $request->input('state');
            $instructorProfileDetail->dob = $dob;
            $instructorProfileDetail->doj = $doj;
            $instructorProfileDetail->dot = $dot;
            $instructorProfileDetail->blood_group_id = $request->input('bloodGroupId');
            $instructorProfileDetail->driving_expirence = $request->input('drivingExpirence');
            $instructorProfileDetail->gender_id = $request->input('genderId');
    
            // Save the instance to the database
            $instructorProfileDetail->save();
    
            // Redirect with success message
            return redirect()->route('instructors.index')
                ->with('success', 'Instructor profile created successfully.');
        
        } elseif ($formType === 'bank_details') {
            // Logic for processing the Bank Details form
            
            // Create and save the InstructorBankDetail instance
            $instructorBankDetail = new InstructorBankDetail();
            // Assign bank-related input data to the model  
            $instructorBankDetail->user_id = $request->input('user_id');
            $instructorBankDetail->salary_pay_mode_id = $request->input('salaryPayModeId');
            $instructorBankDetail->salary_bank_name = $request->input('salaryBankName');
            $instructorBankDetail->salary_branch_name = $request->input('salaryBranchName');
            $instructorBankDetail->salary_ifsc_code = $request->input('salaryIFSCCode');
            $instructorBankDetail->salary_account_number = $request->input('salaryAccountNumber');
            $instructorBankDetail->postal_code = $request->input('postalCode') ?: '000000';
            $instructorBankDetail->state = $request->input('state');
            
            // Save the instance to the database
            $instructorBankDetail->save();
    
            // Redirect with success message
            return redirect()->route('instructors.index')
                ->with('success', 'Instructor bank details created successfully.');
        }
    }
    
    
}
