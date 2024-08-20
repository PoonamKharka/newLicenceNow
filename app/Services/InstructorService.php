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

    public function getAllInstructors(){
        return $this->instRep->getAllInstructors();
    }

}