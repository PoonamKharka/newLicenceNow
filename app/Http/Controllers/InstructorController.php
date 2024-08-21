<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\InstructorService;

class InstructorController extends Controller
{

   protected $instService;
   
   public function __construct(InstructorService $instructorService)
   {
        $this->instService = $instructorService;
   }

   public function index(){
    $userDetails = $this->instService->getAllInstructors();
    return view('admin.instructor.instructor', compact('userDetails'));
   }
}
