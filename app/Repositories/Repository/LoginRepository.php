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
            'username' => $request->username,
            'password' =>  $request->password
        ];

        if( Auth::attempt($credentials)) {
            return redirect('/admin-dashboard')->with('success', 'Login Successfully!');;
        } 
        return back()->with('error', 'Invalid Username or Password');
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