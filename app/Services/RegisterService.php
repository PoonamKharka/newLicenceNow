<?php

namespace App\Services;

use App\Repositories\InterFaces\RegisterRepositoryInterFace;
use Illuminate\Http\Request;

class RegisterService {

    protected $regRep; 

    /** injecting repository */
    public function __construct(RegisterRepositoryInterFace $regRepository) { 
        $this->regRep = $regRepository;
    }

    public function index(){
        return $this->regRep->index();
    }

    public function create() {
        return $this->regRep->create();
    }
}