<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SearchController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/api/instructor-search",
     *     summary="Search all instructors based on location and transmission type",
     *     description="Retrieve a list of all instructors based on location id and transmission type Like:(auto or manula) ",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="locationId",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the location (suburb)"
     *     ),
     *     @OA\Parameter(
     *         name="transmissionType",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="string"),
     *         description="Transmission type of the instructor (e.g. 'auto' or 'manual')"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request"
     *     )
     * )
     */
    public function getAvailableInstructors(Request $request): JsonResponse
    {
       
        try {
            
           // Manual validation using Validator facade
            $validator = Validator::make($request->all(), [
                'locationId' => 'required|numeric|exists:locations,id',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors());
            }
            $transmissionType=($request->transmissionType=='auto')?'isAuto':'isManual';
            $locationId = (int) $request->locationId;
            $responseData = User::whereHas('instructorLocations', function ($query) use ($locationId) {
                $query->where('location_id', $locationId);
            })
            ->with(['profileDetails' => function ($query) use ($transmissionType) {
                $query->where($transmissionType, 1);
            }])
            ->get();
          
            return $this->successResponse($responseData, "Data Found");
        }catch (\Exception $ex) {
            
            return $this->errorResponse($ex);
        }
    }
    /**
     * @OA\Get(
     *     path="/api/instructors",
     *     summary="Get all instructors",
     *     description="Retrieve a list of all instructors",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function getAllInstructors(): JsonResponse {       
       
        try {
            $responseData = User::where('userType_id', 2) 
                ->with('profileDetails')  
                ->get();
            return $this->successResponse($responseData, "Data Found");
        }catch (\Exception $ex) {
            return $this->errorResponse($ex);
        }
    }
    
    /**
     * @OA\Get(
     *     path="/api/suburbs-search",
     *     summary="Search all available locations",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function getAvailableSuburbs(): JsonResponse {
       
        $responseData = [];
        try {
            
            return $this->successResponse($responseData, "Data Found");
        }catch (\Exception $ex) {
            return $this->errorResponse($ex);
        }
    }
}