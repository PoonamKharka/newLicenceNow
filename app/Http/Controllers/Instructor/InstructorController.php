<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\InstructorService;
use App\Http\Requests\StoreInstructorRequest;
use App\Models\Location;
use App\Models\Price;

class InstructorController extends Controller
{

   protected $instService;

   /**
    * inject instructor service into the controller
    */
   public function __construct(InstructorService $instructorService)
   {
      $this->instService = $instructorService;
   }

   /**
    * fetching Instructor list
    */
   public function index(Request $request)
   {
      return $this->instService->getAllInstructors($request);
   }

   public function show($id)
   {
      $userData = $this->instService->profile($id);
       
      $selectedLocationIds = [];
      if (isset($userData->instructorLocations)) {         
         $selectedLocationIds = $userData->instructorLocations->pluck('id')->toArray();
      }     
      $allLocation = Location::select('suburb', 'stateCode', 'postcode')->get();
      
      $selectedPriceIds = [];
      if (isset($userData->instructorPrices)) {         
         $selectedPriceIds = $userData->instructorPrices->pluck('id')->toArray();
      }   

      $allPrices = Price::get();
      return view('admin.instructor.profile', compact('userData', 'allLocation','selectedLocationIds','allPrices','selectedPriceIds'));
   }

   public function store(StoreInstructorRequest $request)
   {
      
      $status = $this->instService->store($request);
      if($status && $request->form_type == "vehicle_details") {
         return redirect()->route('instructors.show' , encrypt($request->instructor_id))->with('success', 'Action completed!');
      }
      if($status){
         return redirect()->route('instructors.show' , encrypt($request->user_id))->with('success', 'Action completed!');
      }else{
         return back()->with('error', 'Failed to save instructor details.');
      }
   }
   public function validatePhone(Request $request)
   {
   return $this->instService->validatePhone($request);
   
   }
   
   public function validateSalaryPayModeId(Request $request)
   {
   return $this->instService->validateSalaryPayModeId($request);
   }
   public function getAllInstructorsRquest(Request $request)
   {
   return $this->instService->getAllInstructorsRquest($request);
   }
   public function updateInstructorStatus(Request $request)
   {
   return $this->instService->updateInstructorStatus($request);
   }
   public function showInstructorRequest($id)
   {
   return $this->instService->showInstructorRequest($id);
   }
   public function updateAttachments(Request $request,$id)
   {
      return $this->instService->updateAttachments($request,$id);
   }

}