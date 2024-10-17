<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\UserType;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\InstructorProfileDetail;
use App\Models\InstructorStatus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule; 
use Illuminate\Support\Str;

class RegistrationController extends BaseController
{
    /**
     * @OA\Post(
     *     path="/api/instructor-register",
     * tags={"Authentication"},
     *     summary="Instructor Registration",
     *     description="Register a new instructor",
     *     @OA\Parameter(
     *         name="first_name",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         description="First Name"
     *     ),
     *     @OA\Parameter(
     *         name="last_name",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         description="Last Name"
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         description="Email"
     *     ),
     *     @OA\Parameter(
     *         name="phoneNo",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         description="Phone Number"
     *     ),
     *     @OA\Parameter(
     *         name="postcode",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         description="Postcode"
     *     ),
     * @OA\Parameter(
     *         name="transmission_type",
     *         in="query",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             enum={"auto", "manual"} 
     *         ),
     *         description="Transmission type: auto or manual"
     *     ),
     *     @OA\Parameter(
     *         name="about_your_self",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="string"),
     *         description="About yourself"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Instructor registered successfully"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request - Validation errors"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error"
     *     )
     * )
     */

    public function instructorRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phoneNo' => 'required|unique:instructor_profile_details,phoneNo',
            'postcode' => 'required|string',
            'transmission_type' => 'required|in:auto,manual',
            'files' => 'nullable|array',  // Accept an array of files
            'files.*' => 'file|mimes:jpeg,png,jpg,pdf|max:2048', // Validate each file for allowed types
        ]);
    
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors());
        }
    
        try {
           
            $password = Str::random(8) . rand(1000, 9999) . '@#';
            $addUser = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($password),
                'userType_id' => 2,
                'isAdmin' => 0,
            ]);
            dd( $addUser);
            if (!$addUser) {
                return $this->errorResponse('Something went wrong during user creation.');
            }
            if($request->transmission_type && $request->transmission_type == "auto") {
                $isManualVal = 0;
                $isAutoVal = 1;
            } else{
                $isManualVal = 1;
                $isAutoVal = 0;
            }
            $instructorProfileDetail = [
                'user_id' => $addUser->id,
                'phoneNo' => $request->phoneNo,
                'about_your_self' => $request->about_your_self,
                'isAuto' => $isAutoVal,
                'isManual' => $isManualVal
            ];
    
            // Handle multiple file uploads
            if ($request->hasFile('files')) {
                $uploadedFiles = [];
                foreach ($request->file('files') as $file) {
                    $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads'), $fileName);
                    $uploadedFiles[] = $fileName; 
                }
                $instructorProfileDetail['uploaded_files'] = json_encode($uploadedFiles); 
            }
    
            InstructorProfileDetail::create($instructorProfileDetail);
    
            InstructorStatus::create([
                'user_id' => $addUser->id,
                'status' => 'pending',
            ]);
    
            return $this->successResponse($addUser->user_id, "Instructor registered successfully.");
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage());
        }
    }
 

    
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