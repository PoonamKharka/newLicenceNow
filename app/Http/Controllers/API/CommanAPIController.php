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
          $allStates = State::all();
          
          return $this->successResponse($allStates, 'State List');
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
            $locations = "https://www.geonames.org/postalcode-search.html?q=&country=AU";
            $mappedLocations = $locations->map( function ($element) {
                return [
                    'suburbs' => $element
                ];
            });
            return $this->successResponse($mappedLocations, 'Suburbs List');
        } catch (Exceptions $ex) {
            Log::log('error', $ex);
            return $this->errorResponse('Error', ['error'=>'"'. $ex . '"']);
        }
    }
}
