<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $instructors = User::where('userType_id', 2) 
        ->with('profileDetails')  
        ->orderBy('created_at', 'desc')
        ->limit(4)
        ->get();
       
        return view('admin.dashboard', compact('instructors'));
    }

}