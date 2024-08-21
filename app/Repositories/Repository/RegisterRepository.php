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
    public function index()
    {
        $allUsers = User::get();
        return view('admin.users.index', compact('allUsers'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

}