<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
   public function index(Request $request)
   {
      return $this->instService->getAllInstructors($request);
   }

   public function show($id)
   {
      $userData = $this->instService->profile($id);
      return view('admin.instructor.profile', compact('userData'));
   }

   public function store(Request $request)
   {
      $status = $this->instService->store($request);
      if($status){
         return redirect()->route('instructors.show' , encrypt($request->user_id))->with('success', 'Action completed!');
      }
   }

}
