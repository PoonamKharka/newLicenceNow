<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\InstructorService;
use App\Http\Requests\StoreInstructorRequest;

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
   public function index(Request $request){
    return $this->instService->getAllInstructors($request);
   }

   /** 
    * to view selected Instructor profile 
    */
   public function show( Request $request, $id) {
      return $this->instService->profile($request, $id);
   }

   public function store(StoreInstructorRequest  $request) {
      return $this->instService->store($request); 
  }
  

}
