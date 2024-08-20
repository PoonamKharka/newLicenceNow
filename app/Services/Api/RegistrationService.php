<?php

namespace App\Services\Api;

use App\Repositories\InterFaces\Api\RegistrationRepositoryInterFace;
use Illuminate\Http\Request;

class RegistrationService {

    protected $regRep; 

    /** registering Repository with service */
    public function __construct(RegistrationRepositoryInterFace $registrationRepository) { 
        $this->regRep = $registrationRepository;
    }

    /** calling RegisterRepo function to register new users */
    public function registerUser(Request $request) {
        return $this->regRep->registerUser($request);
    }

}