<?php

namespace App\Repositories\InterFaces\Api;

use Illuminate\Http\Request;

interface RegistrationRepositoryInterFace {
    
    public function registerUser(Request $request);
}

?>