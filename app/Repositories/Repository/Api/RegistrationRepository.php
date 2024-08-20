<?php

namespace App\Repositories\Repository\Api;

use App\Repositories\InterFaces\Api\RegistrationRepositoryInterFace;
use Illuminate\Http\Request;
use App\Http\Helper\ApiResponse;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class RegistrationRepository implements RegistrationRepositoryInterFace {

    public function registerUser(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users',
            'email' => 'unique:users',
            'password' => 'required|min:4'
        ]);
       

        if ($validator->fails()) {
            return ApiResponse::validationError($validator->messages());
        }

        $name = $request->name;
        $isInstructor = $request->isInstructor;
        $isLearner = $request->isLearner;

        return User::create([
            'name' => $name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'isInstructor' => $isInstructor?$isInstructor:0,
            'isLearner' => $isLearner?$isLearner:0,
        ]);
    }

}