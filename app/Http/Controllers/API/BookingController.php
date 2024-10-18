<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Exceptions;
use Illuminate\Http\Request;
use App\Models\Price;
use App\Models\TestPackage;

class BookingController extends BaseController
{
    /**
     * @OA\Get(
     *  path="/api/prices",
     *  tags={"Booking Steps"},
     *  summary="Prices and Hours details",
     *  @OA\Response(
     *         response=200,
     *         description="OK"
     *   )
     * )
     */
    public function getHoursList() {
        try {
            $list = Price::all('id', 'hours', 'price');
            return $this->successResponse($list, 'Data Found');
        } catch (Exception $ex) {
            Log::log('error', $ex);
            return $this->errorResponse('Error', ['error'=>'"'. $ex . '"']);
        }
    }

    /**
     * @OA/Get(
     *   path="/api/test-package",
     *   tags={"Booking Steps"},
     *   summary("Fetch Test Package Details"),
     *   @OA/Response(
     *       response=200,
     *       description="OK"
     *    )
     * )
     */
    public function getTestPackage(){
        try {
            $testPackage = TestPackage::all();
            return $this->successResponse( $testPackage, 'Data Found' );
        } catch(Exceptions $ex){
            Log::log('error', $ex);
            return $this->errorResponse('Error', ['error'=>'"'. $ex . '"']);
        }
    }

    public function storeBookingRequest(Request $request) {

    }
}
