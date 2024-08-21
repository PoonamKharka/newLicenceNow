<?php

namespace App\Repositories\Repository;

use App\Repositories\InterFaces\InstructorRepositoryInterFace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class InstructorRepository implements InstructorRepositoryInterFace {

    public function getAllInstructors(){
        return User::where('isInstructor', 1)->get();
    }

    //public function 
}