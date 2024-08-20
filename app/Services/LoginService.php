<?php

namespace App\Services;

use App\Repositories\InterFaces\LoginRepositoryInterFace;
use Illuminate\Http\Request;

class LoginService {

    protected $loginRep; 

    /** injecting repository */
    public function __construct(LoginRepositoryInterFace $loginRepository) { 
        $this->loginRep = $loginRepository;
    }


    public function loginPage(){
        return $this->loginRep->loginPage();
    }

    public function postLogin(Request $request) {
        return $this->loginRep->postLogin($request);
    }

    public function logout() {
        return $this->loginRep->logout();
    }
}