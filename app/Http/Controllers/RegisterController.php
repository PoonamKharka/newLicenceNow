<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RegisterService;

class RegisterController extends Controller
{
    protected $regService;

    /**
     * Injecting Register Service into the controller
     */
    public function __construct(RegisterService $regService)
    {
        $this->regService = $regService;
    }

    /**
     * Show users list
     */
    public function index(Request $request) {
        return $this->regService->index($request);
    }

    /**
     * This function is show user registration form
     */
    public function create() {
        return $this->regService->create();
    }
   
    /**
     * For storing user into the database
     * @return view file
     */
    public function store(Request $req) {
        $result =  $this->regService->store($req);
        if( $result ) {
            return redirect()->route('uIndex')->with('status', 'User created successfully.');
        }
    }

    /**
     * For getting user on the basis of pass userid
     */
    public function show($id) {
        $userData =  $this->regService->view($id);
        return view('admin.users.show', compact('userData'));
    }
}
