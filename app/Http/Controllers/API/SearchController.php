<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use App\Models\Location;
use App\Models\InstructorProfileDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

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
            Log::error($ex->getMessage());
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
            Log::error($ex->getMessage());
            return $this->errorResponse($ex);
        }
    }
     /**
     * @OA\Get(
     *     path="/api/instructors/{id}",
     *     summary="Get instructor details",
     *     description="Retrieve detailed information of a specific instructor by their ID.",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the instructor",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful retrieval of instructor details",     *         
     *     )
     * )
     */

    public function getInstructorDetails($id): JsonResponse {       
       
        try {
            $instructor = User::where('userType_id', 2)
            ->where('id', $id)  
            ->with('profileDetails')               
            ->with('instructorLocations')  
            ->with('instructorVehicle')  
            ->with('bankDetails')
            ->with('instructorPrices')   
            ->get();
           
                       
            if (!$instructor) {                
                return $this->successResponse($instructor, "Instructor not found");
            }
            return $this->successResponse($instructor, "Data Found");
        }catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return $this->errorResponse($ex);
        }
    }
    /**
     * @OA\Get(
     *     path="/api/location-search",
     *     summary="Search all location based on street,city or postcode",
     *     description="Retrieve a list of all locations street,city or postcode ",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="s",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="string"),
     *         description="You can enter street or city or postcode "
     *     ),
     *     @OA\Parameter(
     *         name="transmissionType",
     *         in="query",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             enum={"auto", "manual"}, 
     *             description="Select auto (isAuto) or manual (isManual)"
     *         )
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
    
    public function getAvailableSuburbs(Request $request): JsonResponse
    {
        
        $transmissionType = ($request->transmissionType === 'auto') ? 'isAuto' : 'isManual';    

        // Validate input
        $request->validate([
            's' => 'nullable|string|max:255',
            'transmissionType' => 'required|in:auto,manual'
        ]);

        try {
            
            //DB::enableQueryLog();

            // Step 1: Get instructor user IDs based on transmission type
            $userIds = InstructorProfileDetail::where($transmissionType, 1)
                ->where($transmissionType === 'isAuto' ? 'isManual' : 'isAuto', 0)
                ->pluck('user_id')
                ->toArray();

            
            if (empty($userIds)) {
                return $this->successResponse([], "No instructors found for the selected transmission type");
            }

            // Step 2: Search and filter locations based on user input            
            $locationQuery = Location::with(['instructors' => function ($query) use ($userIds) {                
                $query->whereIn('instructor_id', $userIds); 
            }]);

            if ($search = $request->input('s')) {
                $locationQuery->where(function ($query) use ($search) {
                    $query->where('city', 'like', '%' . $search . '%')
                        ->orWhere('state', 'like', '%' . $search . '%')
                        ->orWhere('street', 'like', '%' . $search . '%')
                        ->orWhere('postcode', 'like', '%' . $search . '%');
                });
            }
            
            $responseData = $locationQuery->get();
            
            //Log::info(DB::getQueryLog());

            if ($responseData->isEmpty()) {
                return $this->successResponse($responseData, "No data found");
            }
            
            $response = $responseData->map(function ($location) {
                return [
                    'location' => $location,
                    'instructors' => $location->instructors->map(function ($instructor) {
                        return [
                            'instructor_id' => $instructor->id,
                            'instructor_location_id' => $instructor->pivot->id ?? null,
                            'name' => $instructor->first_name . ' ' . $instructor->last_name,
                        ];
                    }),
                ];
            });

            return $this->successResponse($response, "Data found");

        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return $this->errorResponse($ex);
        }
    }





    

    
}