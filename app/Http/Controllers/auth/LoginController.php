<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\LoginService;
use App\Traits\ApiResponseTrait;

class LoginController extends Controller
{
    use ApiResponseTrait;

    protected $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function index(){
        return $this->loginService->loginPage();
    }

    public function login(Request $request) {
        $data = $this->loginService->postLogin($request);
        if($data) {
            return redirect()->route('dashboard');
        } else {
            return back()->with('error', 'Invalid Login Credentials!');
        }
    }

    public function logout(){
        return $this->loginService->logout();
    }
}
