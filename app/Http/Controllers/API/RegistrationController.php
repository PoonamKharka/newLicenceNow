<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\UserType;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends BaseController
{
    /**
     * Register new user into the system
     * @return \Illuminate\Http\Response
     */
    public function registration(Request $request) {
        
        try {

            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'email' => 'required|unique:users',
                'type' => 'required'
            ]);
     
            if ($validator->fails()) {
                return $this->validationError($validator->messages());
            }
           
            $userType = UserType::where('type', $request->type)->first();
            
            $addUser =  User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'userType_id' => $userType->id,
                'isAdmin' => 0,
            ]);
            
            return $this->successResponse($addUser, "User Created Successfully!");
            
        } catch( \Exception $e) {
            return $this->errorResponse($e);
        }
    }

   
    /**
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Authentication"},
     *     summary="User login",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", example="user@example.com"),
     *             @OA\Property(property="password", type="string", example="your_password")
     *         )
     *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Successful login",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="token", type="string", example="Bearer your_token_here")
    *         )
    *     ),
    *     @OA\Response(
    *         response=401,
    *         description="Unauthorized",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="error", type="string", example="Unauthorized")
    *         )
    *     )
    * )
    */ 
    public function login(Request $request)
    {
        
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('access-token')-> accessToken; 
            $success['userDetails'] =  $user;
            
            return $this->successResponse($success, 'User login successfully');
        } 
        else{ 
            return $this->errorResponse('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }
}