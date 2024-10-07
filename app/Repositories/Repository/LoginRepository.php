<?php

namespace App\Repositories\Repository;

use App\Repositories\InterFaces\LoginRepositoryInterFace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginRepository implements LoginRepositoryInterFace {

    /**
     * Display logi form of admin
     *
     * @return \Illuminate\Http\Response
     */
    public function loginPage()
    {
        return view('admin.auth.login');
    }

    /**
     * for logging in
     *
     * @return \Illuminate\Http\Request
     */
    public function postLogin(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' =>  $request->password
        ];

        $data = [];
        if(Auth::attempt($credentials)) {
            $token = Auth::user()->createToken('passportToken')->accessToken;
            $data = ['token' => $token, 'user' => Auth::user()];
            return $data;
        } else {
            return $data;
        }
    }

    public function showDashboard() 
    {
        return view('admin.dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/admin');
    }
}

?>