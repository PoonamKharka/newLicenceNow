<?php

namespace App\Services;

use App\Repositories\InterFaces\InstructorRepositoryInterFace;
use Illuminate\Http\Request;
use App\Models\InstructorProfileDetail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class InstructorService
{

    protected $instRep;
    /** injecting repository */
    public function __construct(InstructorRepositoryInterFace $instructorRepository)
    {
        $this->instRep = $instructorRepository;
    }

    public function getAllInstructors(Request $request)
    {
        return $this->instRep->getAllInstructors($request);
    }

    public function profile($id)
    {
        return $this->instRep->profile($id);
    }

    public function store(Request $request)
    {
        try {

            // Determine which form was submitted
            $formType = $request->input('form_type');

            if ( $formType === 'personal_details') { 
                if($request->isManual && $request->isManual == "true") {
                    $isManualVal = true;
                } else{
                    $isManualVal = false;
                }
                if($request->isAuto && $request->isAuto == "true") {
                    $isAutoVal = true;
                } else{
                    $isAutoVal = false;
                }
                $dob = Carbon::createFromFormat('d/m/Y', $request->input('date_of_birth'))->format('Y-m-d');
                $doj = Carbon::createFromFormat('d/m/Y', $request->input('date_of_joining'))->format('Y-m-d');
                $dot = $request->input('date_of_termination') ? Carbon::createFromFormat('d/m/Y', $request->input('date_of_termination'))->format('Y-m-d') : null;
                $languages = implode(" , " , $request->languages);
                $request['date_of_birth'] = $dob;
                $request['date_of_joining'] = $doj;
                $request['date_of_termination'] = $dot;
                $instructorProfileDetail = [
                    'user_id' => $request->user_id,
                    'phoneNo' => $request->input('phoneNo'),
                    'languages' => $languages,
                    'contact_address' => $request->contact_address,
                    'date_of_birth' => $dob,
                    'date_of_joining' => $doj,
                    'date_of_termination' => $dot,
                    'blood_group_id' => $request->blood_group_id,
                    'driving_expirence' => $request->driving_expirence,
                    'gender_id' => $request->gender_id,
                    'isAuto' => $isAutoVal,
                    'isManual' => $isManualVal
                ];
                $userData = $this->instRep->store($request);
                
                if( $userData ){
                    $updateDetails =  $userData->update($instructorProfileDetail);
                } else {
                    $updateDetails =  InstructorProfileDetail::create($instructorProfileDetail);
                }
                return $updateDetails;
            }
           
        } catch(\Exception $ex){
            Log::error("Getting some error while adding instructor details =>" . $ex );
        } 
    }
}
