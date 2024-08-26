<?php

namespace App\Services;

use App\Repositories\InterFaces\InstructorRepositoryInterFace;
use Illuminate\Http\Request;

class InstructorService {

    protected $instRep; 
    /** injecting repository */
    public function __construct(InstructorRepositoryInterFace $instructorRepository) { 
        $this->instRep = $instructorRepository;
    }

    public function getAllInstructors(Request $request){
        return $this->instRep->getAllInstructors($request);
    }

    public function profile($request, $id) {
        return $this->instRep->profile($request, $id);
    }

}