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

    public function index($req){
        return $this->regRep->index($req);
    }

    public function create() {
        return $this->regRep->create();
    }

    public function store(Request $req){
        return $this->regRep->store($req);
    }

    public function view($id) {
        return $this->regRep->view($id);
    }

    public function update(Request $req , $id) {
        return $this->regRep->updateData($req , $id);
    }

    public function delete($id) {
        return $this->regRep->delete($id);
    }
    public function userProfile($id){
        return  $this->regRep->userProfile($id);
    }
}