<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\UserType;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends BaseController
{
    /**
     * Register new user into the system
     * @return \Illuminate\Http\Response
     */
    public function registration(Request $request): JsonResponse {
        
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
     * @OA\Put(
     *     path="/users/{id}",
     *     summary="Updates a user",
     *     @OA\Parameter(
     *         description="Parameter with mutliple examples",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         @OA\Examples(example="int", value="1", summary="An int value."),
     *         @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value."),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function login(Request $request): JsonResponse
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
