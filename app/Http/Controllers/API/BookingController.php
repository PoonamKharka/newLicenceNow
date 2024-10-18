<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Price;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class BookingController extends BaseController
{
    /**
     * @OA\Get(
     *  path="/api/login",
     *  tags={"Booking"},
     *  summary="Prices and Hours details",
     *  security={{"bearerAuth": {}}},
     *  @OA\Response(
     *         response=200,
     *         description="OK"
     *   )
     * )
     */
    public function getHoursList() {
        try {
            if( Auth::user() ) {
                $list = Price::pluck( 'hours' , 'price');
                return $this->successResponse($list, 'User login successfully');
            } else {
                return $this->errorResponse('Unauthorized Access', ['Please login into the system first']);
            }
        } catch (\Exception $ex) {
            Log::log('error', $ex);
            return $this->errorResponse('Error', ['error'=>'"'. $ex . '"']);
        }
    }

    public function storeBookingRequest(Request $request) {

    }
}
