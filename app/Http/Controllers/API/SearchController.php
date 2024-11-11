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
use App\Models\InstructorPrice;

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
     
   /**
     * @OA\Post(
     *     path="/api/instructors-list",
     *     tags={"General"},
     *     summary="Search all instructors based on queried street,city or postcode",
     *     description="Retrieve a list of all instructors",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *             @OA\Property( 
     *                property="postcode",
     *                oneOf={
     *                   @OA\Schema(type="string"),
     *                   @OA\Schema(type="integer"),
     *                }
     *              ),
     *             @OA\Property( 
     *                property="transmissionType",
     *                type="string",
     *              )
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
    public function getAvailableInstructors(Request $request)
    {
       
        try { 
            // Validate input
            $validator = Validator::make($request->all(), [
                'postcode' => 'required',
                'transmissionType' => 'required|in:auto,manual'
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors());
            }

            $transmissionType = ($request->transmissionType == 'auto' ) ? 2 : 3;

            switch ($transmissionType) {
                case '2':
                    $instructorList = User::whereIn('transmission_id', [ 2 , 1])
                    ->where('postcode', $request->postcode)
                    ->with(['instructorProfileDetail'])
                    ->get();
                    break;
                case '3':
                    $instructorList = User::whewhereInre('transmission_id', [3 , 1])
                                ->where('postcode', $request->postcode)
                                ->with('instructorProfileDetail')
                                ->get();
                    break;
                default:
                    $instructorList = User::with('instructorProfileDetail')
                    ->get();
                    break;
            }
            
            $listingData = [];
            //This condition is for when data found
            if( count($instructorList) > 0) {
                foreach ($instructorList as $instructors) {
                    //dd($instructors);
                    $getPrice = InstructorPrice::where('instructor_id', $instructors->id)
                                ->with(['prices' => function ($query) {
                                    $query->where('hours', 1)->select('id', 'hours','price');
                                }])->first();
                    
                    if( $getPrice ){
                        $no = $getPrice->prices[0]['price'] + 8;
                        $lessonPrice = '$' . $getPrice->prices[0]['price'] . '-$' . number_format((float)$no, 2, '.', '') . ' per hour';
                    } else {
                        $lessonPrice = 'Not Disclosed';
                    }
                    
                    $listingData[] = [
                        'instructor_id' => $instructors->id, 
                        'profile_picture' => ( $instructors->instructorProfileDetail ) ? $instructors->instructorProfileDetail->profile_picture : null,
                        'first_name' => $instructors->first_name,
                        'prices' => $lessonPrice,
                        'reviews' => '4.93 (134 Reviews)',
                        'lessons' => '198 Lessons Completed' 
                    ];
                }
            } 

            return $this->successResponse($listingData, "Data Found");
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