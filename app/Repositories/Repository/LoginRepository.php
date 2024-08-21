<?php

namespace App\Repositories\Repository;

use App\Repositories\InterFaces\LoginRepositoryInterFace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

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

    public function registeration(Request $request){

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

?>