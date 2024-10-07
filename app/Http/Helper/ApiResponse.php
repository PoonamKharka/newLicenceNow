<?php

namespace App\Http\Helper;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiResponse extends JsonResource {

    public static function success($data, $message = null)
    {
        response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ]);
    }
 
    public static function error($message, $statusCode = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $statusCode);
    }
 
    public static function validationError($errors)
    {
        return response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'errors' => $errors
        ], 422);
    }

}
?>