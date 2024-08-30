<?php

namespace App\Http\Controllers;

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

   public function show(Request $request, $id)
   {
      return $this->instService->profile($request, $id);
   }

   public function store(Request  $request)
   {
      return $this->instService->store($request);
   }

   public function edit($id)
   {
      $userData =  $this->instService->view($id);
      $userData->profileDetails->dob = Carbon::parse($userData->profileDetails->dob)->format('d/m/Y');
      $userData->profileDetails->doj = Carbon::parse($userData->profileDetails->doj)->format('d/m/Y');
      $userData->profileDetails->dot = Carbon::parse($userData->profileDetails->dot)->format('d/m/Y');
      return view('admin.instructor.show', compact('userData'));
   }

   public function update(Request $request, $id)
   {
      return $this->instService->update($request, $id);
   }
}
