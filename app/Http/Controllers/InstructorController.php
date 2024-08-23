<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\InstructorService;

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
}
