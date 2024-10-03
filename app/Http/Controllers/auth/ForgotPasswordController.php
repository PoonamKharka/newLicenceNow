<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ForgotPasswordService;
use App\Traits\ApiResponseTrait;

class ForgotPasswordController extends Controller
{
    use ApiResponseTrait;

    protected $forgotPasswordService;

    public function __construct(ForgotPasswordService $forgotPasswordService)
    {
        $this->forgotPasswordService = $forgotPasswordService;
    }

    public function showLinkRequestForm(){
        return $this->forgotPasswordService->showLinkRequestForm();
    }

    public function sendResetLinkEmail(Request $request) {
       return $this->forgotPasswordService->sendResetLinkEmail($request);
        
    }

    public function showResetForm(Request $request){
        return $this->forgotPasswordService->showResetForm($request);
    }
    public function reset(Request $request){
        return $this->forgotPasswordService->reset($request);
    }
}