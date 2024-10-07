<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse as IlluminateJsonResponse;

/**
 * @OA\Info(
 *  version="1.0",
 *  title="Licence Now API documentation",
 *  description="API documentation for developer reference"
 * )
 * @OA\SecurityScheme(
 * type="http",
 * securityScheme="bearerAuth",
 * scheme="bearer",
 * bearerFormat="Passport"
 * )
 */
class BaseController extends IlluminateJsonResponse
{
    
    /**
     * this function is to setting up success api resoponse
     * @return json 
     */
    protected function successResponse($data = [], $message = 'Success', $code = 200): IlluminateJsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * This function is for setting up error api resoponse
     * @return json
     */
    protected function errorResponse($message = 'Error', $code = 400): IlluminateJsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $code);
    }

    /**
     * This function is for setting up validation api resoponse
     * @return json
     */
    public function validationError($message = 'Validation Error', $code = 422):IlluminateJsonResponse 
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $code);
    }
}