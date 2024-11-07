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
use Illuminate\Support\Facades\Exceptions;

class SearchController extends BaseController
{
    
    /**
     * @OA\Post(
     *     path="/api/find-suburbs",
     *     tags={"General"},
     *     summary="Search all location based on queried street,city or postcode",
     *     description="Retrieve a list of all locations",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *             @OA\Property( 
     *                property="filter",
     *                oneOf={
     *                   @OA\Schema(type="string"),
     *                   @OA\Schema(type="integer"),
     *                }
     *              ),
     *           )
     *        )
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
    public function getAllSuburbs(Request $request): JsonResponse
    {
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
     
    /* 
     * Get Latest instrunctors 
    */
     public function getLatestInstructors()
     {
        try {
            $instrutors = User::whereHas('userType', function ($query) {
                $query->where('type', '=', 'Instructor');
            })->select('*')->orderBy('created_at', 'DESC')->get();
            
            return $instrutors;
        }catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return $this->errorResponse($ex);
        }
     }
     
    /* 
     * Get all instrunctor based on location id 
    */
    public function getAvailableInstructors(Request $request)
    {
       
        try { 
            // Validate input
            $validator = Validator::make($request->all(), [
                'suburb' => 'required',
                'transmissionType' => 'required|in:auto,manual'
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors());
            }

            $transmissionType = ($request->transmissionType == 'auto' ) ? 'isAuto' : 'isManual';
            
            if ( $transmissionType == 'isAuto' ) {
                $instructorList = InstructorProfileDetail::where('isAuto', 1)->with('prices')->get();
            } 

            if( $transmissionType == 'isManual' ){
                $instructorList = InstructorProfileDetail::where('isManual', 1)->with('prices')->get();
            }
           
            return $this->successResponse($instructorList, "Data Found");
        }catch (Exception $ex) {
            Log::error($ex->getMessage());
            return $this->errorResponse($ex);
        }
    }
    /**
     * @OA\Get(
     *     path="/api/instructors",
     * tags={"General"},
     *     summary="Get list of all other instructors",
     * 
     *     description="Retrieve a list of all instructors",
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
     *     path="/api/instructor/{id}",
     * tags={"General"},
     *     summary="Get instructor detail based on id",
     *     description="Retrieve details of an instructor by their ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="The ID of the instructor",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
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

}