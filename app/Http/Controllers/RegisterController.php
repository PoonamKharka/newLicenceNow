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
            return redirect()->route('users.index')->with('status', 'User created successfully.');
        }
    }

    /**
     * For getting user on the basis of pass userid
     */
    public function show($id) {
        $userData =  $this->regService->view($id);
        return view('admin.users.show', compact('userData'));
    }

    /**
     * For updating the record
     */
    public function update(Request $request , $id){
        
        $request->validate([
            'email' => 'required',
            'first_name' => 'required',
        ]);

        $update = $this->regService->update($request, $id);
        if($update) {
            return redirect()->route('users.index')->with('status', 'User Updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        return  $this->regService->delete($id);
    }
    /**
     * Show user profile.
    */
    public function userProfile($id){
        $user=$this->regService->userProfile($id);        
        return view('admin.users.profile', compact('user'));
    }
}