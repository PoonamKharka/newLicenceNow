<?php

namespace App\Repositories\Repository;

use App\Models\LearnerBankDetails;
use App\Models\LearnerProfileDetails;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Repositories\InterFaces\LearnerRepositoryInterface;

class LearnerRepository implements LearnerRepositoryInterface
{
      public function getAllLearners(Request $request)
      {

            if ($request->ajax()) {
                  $learners = User::whereHas('userType', function ($query) {
                        $query->where('type', '=', 'Learner');
                  })->select('*');

                  return datatables()->of($learners)
                        ->editColumn('status', function ($row) {
                              if ($row->status == 1) {
                                    return 'Active';
                              } else {
                                    return 'Inactive';
                              }
                        })
                        ->addColumn('action', function ($row) {
                              $btn = '<a href="' . route('learners.show', encrypt($row)) . '" class="btn btn-sm btn-success">
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
            return view('admin.learner.index');
      }

      public function profile($request, $data)
      {
            $users = decrypt($data);
            $userData =  User::with('learnerBankDetails', 'learnerProfileDetails')->findOrFail($users->id);
            if ($userData->learnerProfileDetails) {
                  $userData->learnerProfileDetails->dob = Carbon::parse($userData->learnerProfileDetails->dob)->format('d/m/Y');
                  $userData->learnerProfileDetails->csd = Carbon::parse($userData->learnerProfileDetails->csd)->format('d/m/Y');
                  $userData->learnerProfileDetails->ced = Carbon::parse($userData->learnerProfileDetails->ced)->format('d/m/Y');
            }

            return view('admin.learner.profile', compact('userData'));
      }

      public function store(Request $request)
      {
            // dd($request->all());
            $formType = $request->input('form_type');
            if ($formType === 'personal_details') {

                  // Logic for processing the Personal Details form

                  // Convert dates from d/m/Y to Y-m-d using Carbon
                  $dob = Carbon::createFromFormat('d/m/Y', $request->input('dob'))->format('Y-m-d');
                  $csd = Carbon::createFromFormat('d/m/Y', $request->input('csd'))->format('Y-m-d');
                  $ced = $request->input('ced') ? Carbon::createFromFormat('d/m/Y', $request->input('ced'))->format('Y-m-d') : null;

                  // Calculate the age based on the date
                  $age = Carbon::parse($dob)->age;

                  $learnerProfileDetails = new LearnerProfileDetails();

                  $learnerProfileDetails = [
                        'user_id' => $request->input('user_id'),
                        'dob' => $dob,
                        'age' => $age,
                        'course_start' => $csd,
                        'course_end' => $ced,
                        'phoneNo' => $request->input('phoneNo'),
                        'corresponding_address' => $request->input('correspondingAddress'),
                        'blood_group_id' => $request->input('bloodGroupId'),
                        'gender_id' => $request->input('genderId'),
                  ];
                  // dd($learnerProfileDetails);
                  //Handle the profile p[icture uploading

                  if ($request->hasFile('profilePicture')) {
                        $imageFileName = time() . '_image.' . $request->file('profilePicture')->getClientOriginalExtension();
                        $request->file('profilePicture')->move(public_path('learnerProfile'), $imageFileName);
                        $learnerProfileDetails['profile_picture'] = 'learnerProfile/' . $imageFileName;
                  }

                  $findUser = LearnerProfileDetails::where('user_id', '=', $request->input('user_id'))->first();

                  if ($findUser) {
                        $updateDetails = $findUser->update($learnerProfileDetails);
                  } else {
                        $updateDetails = LearnerProfileDetails::create($learnerProfileDetails);
                  }
                  if ($updateDetails) {
                        return back()->with('Success', 'Data has been added..!');
                  }
            } elseif ($formType === 'bank_details') {
                  // Logic for processing the Bank Details form

                  // Prepare the data as an associative array
                  $learnerBankDetails = [
                        'user_id' => $request->input('user_id'),
                        'salary_pay_mode_id' => $request->input('salaryPayModeId'),
                        'salary_bank_name' => $request->input('salaryBankName'),
                        'salary_branch_name' => $request->input('salaryBranchName'),
                        'salary_ifsc_code' => $request->input('salaryIFSCCode'),
                        'salary_account_number' => $request->input('salaryAccountNumber'),
                  ];
                  // Check if the record exists
                  $findUser = LearnerBankDetails::where('user_id', '=', $request->input('user_id'))->first();
                  if ($findUser) {
                        // Update the existing  record
                        $updateDetails = $findUser->update($learnerBankDetails);
                  } else {
                        // Create a new record
                        $updateDetails = LearnerBankDetails::create($learnerBankDetails);
                  }
                  if ($updateDetails) {
                        // Redirect with success message
                        return  redirect()->route('learners.index')->with('success', 'Learners bank details saved successfully.');
                  } else {
                        // Handle failure (if needed)
                        return back()->with('error', 'Failed to save Learner bank details.');
                  }
            }
      }
}
