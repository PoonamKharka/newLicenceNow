<?php

namespace App\Repositories\Repository;

use App\Models\User;
use Mockery\Instantiator;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\InstructorBankDetail;
use App\Models\InstructorProfileDetail;
use App\Models\InstructorRequest;
use App\Models\MediaAttachment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Repositories\InterFaces\InstructorRepositoryInterFace;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

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
    public function getAllInstructorsRquest($request)
    {
       
        if ($request->ajax()) {
            $instrutors = InstructorRequest::select('*')->orderBy('created_at', 'DESC');
        
            return datatables()->of($instrutors)
            ->addColumn('status', function ($row) { 
                // Disable the dropdown if status is 'approve'
                $isApproved = $row->status == "approve";
                
                // Button
                $dropdown = '<div class="dropdown">';
                $dropdown .= '<button class="btn btn-sm ' . ($isApproved ? 'btn-success' : 'btn-primary') . ' dropdown-toggle" type="button" id="statusDropdown' . $row->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ' . ($isApproved ? 'disabled' : '') . '>';
                $dropdown .= ucfirst($row->status);  
                $dropdown .= '</button>';
                
                // Dropdown menu
                $dropdown .= '<div class="dropdown-menu" aria-labelledby="statusDropdown' . $row->id . '" ' . ($isApproved ? 'style="pointer-events: none; opacity: 0.5;"' : '') . '>';
                
                // Pending option
                $pendingClass = $row->status == "pending" ? 'active disabled' : '';
                $dropdown .= '<a href="javascript:void(0)" class="dropdown-item ' . $pendingClass . '" data-id="' . $row->id . '" id="pending">Pending</a>';
                
                // Approved option
                $approveClass = $isApproved ? 'active disabled' : ''; // Use $isApproved here
                $dropdown .= '<a href="javascript:void(0)" class="dropdown-item ' . $approveClass . '" data-id="' . $row->id . '" id="approve">Approved</a>';
                
                // Hold option
                $holdClass = $row->status == "hold" ? 'active disabled' : '';
                $dropdown .= '<a href="javascript:void(0)" class="dropdown-item ' . $holdClass . '" data-id="' . $row->id . '" id="hold">Hold</a>';
                
                // Rejected option
                $rejectClass = $row->status == "rejected" ? 'active disabled' : '';
                $dropdown .= '<a href="javascript:void(0)" class="dropdown-item ' . $rejectClass . '" data-id="' . $row->id . '" id="reject">Reject</a>';
                
                $dropdown .= '</div>';  
                $dropdown .= '</div>';  

                return $dropdown;
            })
            ->addColumn('action', function ($row) {
                
                $btn = '<button class="btn btn-sm btn-info view-btn pl-3 pr-3" data-id="' . $row->id . '" data-toggle="modal" data-target="#instructorModal">View</button>';  

                return $btn;
            })
            ->rawColumns(['status','action'])
                ->make(true);
        }
        return view('admin.instructor.request-index');
    }
    public function updateInstructorStatus($request)
    {
        DB::beginTransaction();

        try {
            $status = $request->status ?? null;
            $instructor = InstructorRequest::findOrFail($request->id);
            $instructor->update(['status' => $status]);

            if ($status === 'approve') {
                
                // Check if user with the given email already exists
                if (User::where('email', $instructor->email)->exists()) {
                    DB::rollBack();  
                    return response()->json(['success' => false, 'message' => 'Instructor email already exists.']);
                }

                // Generate password and create a new user
                $password = Str::random(8) . rand(1000, 9999) . '@#';
                $user = User::create([
                    'first_name' => $instructor->first_name,
                    'last_name' => $instructor->last_name,
                    'email' => $instructor->email,
                    'contact_no' => $instructor->phoneNo,
                    'postcode' => $instructor->postcode,
                    'password' => Hash::make($password),
                    'userType_id' => 2,
                    'isAdmin' => 0,
                ]);

                // Assing instructor to media attachments, if any
                InstructorRequest::where('id', $request->id)
                    ->update(['user_id' => $user->id]);
            }

            DB::commit(); 
            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
            
        } catch (\Exception $ex) {
            DB::rollBack();  
            Log::error($ex);
            return response()->json(['success' => false, 'message' => $ex->getMessage()]);
        }
    }
    public function showInstructorRequest($id)
    {
        try {
            $instructor = InstructorRequest::with('mediaAttachments')->findOrFail($id);
            return view('admin.instructor.request-show', compact('instructor'))->render();
        } catch (\Exception $ex) {
           
            Log::error($ex);
            return response()->json(['success' => false, 'message' => $ex->getMessage()]);
        }
    }
    public function updateAttachments(Request $request,$id)
    {
        try {
        
            $validatedData = $request->validate([
                'media_attachment_status' => 'required', 
            ]);
    
            $statusUpdates = $validatedData['media_attachment_status'];
            $attachment = MediaAttachment::findOrFail($id);
            $attachment->update(['file_status' => $statusUpdates]);
            
            return response()->json(['message' => 'Status updated successfully']);
        }catch (\Exception $ex) {
            Log::error($ex);
            return response()->json(['success' => false, 'message' => $ex->getMessage()]);
        }
    }
}