<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\LoginService;

class LoginController extends Controller
{

    protected $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function index(){
        return $this->loginService->loginPage();
    }

    public function login(Request $request){
        return $this->loginService->postLogin($request);
    }

    public function logout(){
        return $this->loginService->logout();
    }
}
