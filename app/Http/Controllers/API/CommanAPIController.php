<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Exceptions;
use App\Models\State;

class CommanAPIController extends BaseController
{
    /**
     * @OA\Get(
     *   path="/api/states",
     *   tags={"Common APIs"},
     *   summary="List of States",
     *   @OA\Response(
     *     response=200,
     *     description="OK"
     *   )
     * )
     */
    public function getStates() {
        try {
          $allStates = State::all();
          
          return $this->successResponse($allStates, 'State List');
        } catch (Exceptions $ex) {
            Log::log('error', $ex);
            return $this->errorResponse('Error', ['error'=>'"'. $ex . '"']);
        }
    }
}
