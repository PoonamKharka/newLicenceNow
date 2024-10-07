<?php

namespace App\Services;

use App\Repositories\InterFaces\ForgotPasswordRepositoryInterFace;
use Illuminate\Http\Request;

class ForgotPasswordService {

    protected $forgotPasswordRep; 

    /** injecting repository */
    public function __construct(ForgotPasswordRepositoryInterFace $forgotPasswordRepository) { 
        $this->forgotPasswordRep = $forgotPasswordRepository;
    }


    public function showLinkRequestForm(){
        return $this->forgotPasswordRep->showLinkRequestForm();
    }

    public function sendResetLinkEmail(Request $request) {
        return $this->forgotPasswordRep->sendResetLinkEmail($request);
    }

    public function showResetForm(Request $request, $token = null) {
        return $this->forgotPasswordRep->showResetForm($request,$token);
    }
    public function reset(Request $request) {
        return $this->forgotPasswordRep->reset($request);
    }
}