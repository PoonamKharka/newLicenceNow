<?php

namespace App\Services;

use App\Repositories\InterFaces\InstructorRepositoryInterFace;
use Illuminate\Http\Request;
use App\Models\InstructorProfileDetail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\InstructorVehicle;
use App\Models\InstructorBankDetail;
use App\Models\InstructorLocation;

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
               
                if ($request->hasFile('profile_picture')) {
                    $imageFileName = time() . $request->file('profile_picture')->getClientOriginalExtension();
                    $request->file('profile_picture')->move(public_path('profile'), $imageFileName);
                    $instructorProfileDetail['profile_picture']=$imageFileName;
                }
                
                $userData = $this->instRep->store($request);
              
                if( $userData ){
                  
                    $updateDetails =  $userData->update($instructorProfileDetail);
                    
                } else {
                    
                    $updateDetails =  InstructorProfileDetail::create($instructorProfileDetail);
                    
                }
               
                return $updateDetails;
            } 

            if( $formType === 'vehicle_details' ) {
                try { 
                    
                    
                    $vehicleDataArray = [
                        'instructor_id' => $request->instructor_id,
                        'vehicle_name' => $request->vehicle_name,
                        'vehicle_no'=> $request->vehicle_no,
                        'ancap_rating'=> $request->ancap_rating
                    ];
                    if($request->vehicle_image) {
                        $imageName = time().'.'.$request->vehicle_image->extension();
                        $request->vehicle_image->move(public_path('vehicles'), $imageName);
                        $vehicleDataArray['vehicle_image']=$imageName;
                    }
                    
                    $vehicleData = InstructorVehicle::where('instructor_id', $request->instructor_id)->first();
                    if($vehicleData){
                        
                        $storeVehicleData = $vehicleData->update($vehicleDataArray);
                    } else {
                       
                        $storeVehicleData = InstructorVehicle::create($vehicleDataArray);
                    }
                    
                    return $storeVehicleData;
                }catch (\Exception $e) {                                       
                  
                    return redirect()->back()->withErrors($e->getMessage())->withInput();
                }
            }

            if ( $formType === 'bank_details') {
                
                $instructorBankDetail = [
                    'user_id' => $request->input('user_id'),
                    'salary_pay_mode_id' => $request->input('salaryPayModeId'),
                    'salary_bank_name' => $request->input('salaryBankName'),
                    'salary_branch_name' => $request->input('salaryBranchName'),
                    'salary_ifsc_code' => $request->input('salaryIFSCCode'),
                    'salary_account_number' => $request->input('salaryAccountNumber'),
                ];
                    
                $findBankDetails = InstructorBankDetail::where('user_id', $request->input('user_id'))->first();
                try {  
                    if( $findBankDetails ){
                        $updateBankDetails =  $findBankDetails->update($instructorBankDetail);
                    } else {                                            
                            $updateBankDetails = InstructorBankDetail::create($instructorBankDetail);
                        } 
                    

                    return $updateBankDetails;
                }
                catch (\Exception $e) {                       
                    return redirect()->back()->withErrors($e->getMessage())->withInput();
                }
            }

            if( $formType === 'suburbs_details') {
               
                if( $request['location_id']) { 
                    $locationData=[];
                    foreach ($request['location_id'] as $value) {
                        
                        $suburbData = [
                            'instructor_id' => $request->user_id,
                            'location_id' => $value
                        ];
                        // InstructorLocation::where('instructor_id' ,  $request->user_id)->delete();
                        // $locationData = InstructorLocation::create($suburbData);
                        
                        $currentLocations = InstructorLocation::where('instructor_id', $request->user_id)
                            ->pluck('location_id') 
                            ->toArray();                        
                        $newSelections = $request['location_id'] ?? []; 
                        $locationsToDelete = array_diff($currentLocations, $newSelections);
                        if (!empty($locationsToDelete)) {
                            InstructorLocation::where('instructor_id', $request->user_id)
                                ->whereIn('location_id', $locationsToDelete)
                                ->delete();
                        }
                        if(!empty($newSelections)){
                            foreach ($newSelections as $value) {
                                $suburbData = [
                                    'instructor_id' => $request->user_id,
                                    'location_id' => $value
                                ];                            
                                $locationData=InstructorLocation::updateOrCreate(
                                    [
                                        'instructor_id' => $request->user_id,
                                        'location_id' => $value
                                    ],
                                    $suburbData
                                );
                            
                            }
                        }
                        
                    }
                    return $locationData;
                }
            }
           
        } catch(\Exception $ex){
            Log::error("Getting some error while adding instructor details =>" . $ex );
        } 
    }
    public function validatePhone($phoneNo)
    {
        return $this->instRep->validatePhone($phoneNo);
    }
    public function validateSalaryPayModeId($salaryPayModeId)
    {
        return $this->instRep->validateSalaryPayModeId($salaryPayModeId);
    }
}