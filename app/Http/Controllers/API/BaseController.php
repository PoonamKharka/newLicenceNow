<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *  version="1.0",
 *  title="LicenceNow API Documentation",
 *  description="API documentation for developer reference"
 * )
 * @OA\SecurityScheme(
 * type="http",
 * securityScheme="bearerAuth",
 * scheme="bearer",
 * bearerFormat="Passport"
 * )
 */
class BaseController extends Controller
{
    
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function successResponse($result, $message)
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data'    => $result,
        ];
  
        return response()->json($response, 200);
    }
  
    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function errorResponse($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
  
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
  
        return response()->json($response, $code);
    }

    /**
     * This function is for setting up validation api resoponse
     * @return json
     */
    public function validationError($error, $errorMessages = [], $code = 422) 
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
  
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
  
        return response()->json($response, $code);
    }
}