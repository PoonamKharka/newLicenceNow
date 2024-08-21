<?php

namespace App\Repositories\Repository;

use App\Repositories\InterFaces\RegisterRepositoryInterFace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class RegisterRepository implements RegisterRepositoryInterFace {

    /**
     * Display users list
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searching = $request->get('search');

        if($searching != '') {
            $allUsers = User::where('name', 'LIKE' , "%{$searching}%")
            ->get();
        } else {
            $allUsers = User::where('isAdmin' , '=', 0 )->get()->toArray();
        }
       
        return view('admin.users.index', compact('allUsers'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store( Request $request) {
        $name = $request->name;

        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:4',
            'email' => 'required|email|unique:users'
        ],[
            'username.required' => 'User Name field is required.',
            'password.required' => 'Password field is required.',
            'email.required' => 'Email field is required.',
            'email.email' => 'Email field must be email address.'
        ]);

        if( $request->userType == "isInstructor") {
            $isInstructor = 1; 
        } else {
            $isInstructor = 0;
        }
        if( $request->userType == "isLearner") {
            $isLearner = 1; 
        } else {
            $isLearner = 0;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'isLearner' =>  $isInstructor,
            'isInstructor' => $isLearner,
            'status' => 1,
            'password' => bcrypt($request->password)
        ]);

        return $user;
    }

    public function view($id) {
        $userId = decrypt($id); 
        return User::findOrFail($userId);
        
    }

}