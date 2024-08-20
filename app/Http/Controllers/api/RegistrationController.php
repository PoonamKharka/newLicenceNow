<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Api\RegistrationService;
use App\Http\Helper\ApiResponse;

class RegistrationController extends Controller
{
    protected $regService;

    public function __construct(RegistrationService $registrationService)
    {
        $this->regService = $registrationService;
    }


    public function registration(Request $request) {
        try {
            $addUser = $this->regService->registerUser($request);
            return ApiResponse::success($addUser, "User Created Successfully!");
        } catch( \Exception $e) {
            return ApiResponse::error($e);
        }
    }
}
