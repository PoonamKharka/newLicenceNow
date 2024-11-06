<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Exceptions;
use App\Models\State;
use App\Models\Location;

class CommanAPIController extends BaseController
{
    /**
     * @OA\Get(
     *   path="/api/states",
     *   tags={"General"},
     *   summary="List of States",
     *   @OA\Response(
     *     response=200,
     *     description="OK"
     *   )
     * )
     */
    public function getStates() {
        try {
          $allStates = State::all('id', 'name', 'slug');
          
          return $this->successResponse($allStates, 'Data Found');
        } catch (Exceptions $ex) {
            Log::log('error', $ex);
            return $this->errorResponse('Error', ['error'=>'"'. $ex . '"']);
        }
    }

    /**
     * @OA\Get(
     *   path="/api/suburbs",
     *   tags={"General"},
     *   summary="List of Suburbs",
     *   @OA\Response(
     *     response=200,
     *     description="OK"
     *   )
     * )
     */
    public function getSuburbs(Request $request) {
        try {
            
            $search = preg_replace('/[^A-Za-z0-9 ]/', '', $request->filter);
            $locations = Location::select('id','suburb', 'stateCode', 'postcode')
                        ->whereAny([
                            'suburb',
                            'stateCode',
                            'postcode',
                        ], 'like', '%'. $search . '%')
                        ->get();
            
            if(count($locations) > 0) {
                return $this->successResponse($locations, 'Data Found');
            } else {
                return $this->successResponse([], 'No Data Found');
            }
            
        } catch (Exceptions $ex) {
            Log::log('error', $ex);
            return $this->errorResponse('Error', ['error'=>'"'. $ex . '"']);
        }
    }
}
