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
            $sortedList = [];
            foreach ( $list as $value ) {
                $newList = [
                    'hours' => $value->hours,
                    'price' => '$' . $value->price . '/hr'
                ];
                $sortedList['hour_unit'] = 'hr(s)';
                $sortedList['data'][] = $newList;
            }

            return $this->successResponse($sortedList, 'Prices and Hours details');
        } catch (Exception $ex) {
            Log::log('error', $ex);
            return $this->errorResponse('Error', ['error'=>'"'. $ex . '"']);
        }
    }

    /**
     * @OA\Get(
     *   path="/api/test-package",
     *   tags={"Booking Steps"},
     *   summary="Fetch Test Package Details",
     *   @OA\Response(
     *       response=200,
     *       description="OK"
     *    )
     * )
     */
    public function getTestPackage(){
        try {
            $testPackage = TestPackage::all();
            return $this->successResponse( $testPackage, 'Test Package Details' );
        } catch(Exceptions $ex){
            Log::log('error', $ex);
            return $this->errorResponse('Error', ['error'=>'"'. $ex . '"']);
        }
    }

    /**
     * @OA\Get(
     *   path="/api/pricing-structure",
     *   tags={"Booking Steps"},
     *   summary="Driving Lesson Pricing Structure",
     *   @OA\Response(
     *       response=200,
     *       description="OK"
     *    )
     * ) 
     */
    public function pricingStructure() {
        try {

            $mappedData = [
                    '1-5 hours' => '$105.00 / hr',
                    '5-9 hours' => '$95.00 / hr',
                    '10+ hours' => '$85.00 / hr',
            ];

            return $this->successResponse( $mappedData, 'Driving Lesson Pricing Structure' );
        } catch(Exceptions $ex){
            Log::log('error', $ex);
            return $this->errorResponse('Error', ['error'=>'"'. $ex . '"']);
        }
    }
}
