<?php

namespace App\Traits;

trait ApiResponseTrait
{
    /**
     * setting up common function for api success response
     * @return json
     */
    public function successResponse($data, $redirect) {
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'redirect' => $redirect
        ], 200);
    }

    /**
     * setting up common function for api error response
     * @return json
     */
    public function errorResponse($message, $code = 400, $details = []) {
        return response()->json([
            'status' => 'error',
            'error' => [
                'code' => $code,
                'message' => $message,
                'details' => $details
            ],
        ]);
    }
}
