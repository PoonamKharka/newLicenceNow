<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\JsonResponse;
use App\Models\AboutUs;
use App\Models\Faq;
use App\Models\Feature;
use Illuminate\Support\Facades\Auth;

class ArticleController extends BaseController
{
     /**
     * Display about us data
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function getDataOfAboutUs(): JsonResponse {
       
        try {
            $aboutUs = AboutUs::get();
            return $this->successResponse($aboutUs, "Data Found");
        } catch (\Exception $ex) {
            return $this->errorResponse($ex);
        }
    }

   
    /**
     * @OA\Get(
     *     path="/api/faqs",
     *     summary="Get all FAQs",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function getAllFaqs(): JsonResponse {
       
        try {
            $faqs = Faq::get();
            return $this->successResponse($faqs, "Data Found");
        } catch (\Exception $ex) {
            return $this->errorResponse($ex);
        }
    }
    
    /**
     * @OA\Get(
     *     path="/api/features",
     *     summary="Get all features",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function getAllFeatures(): JsonResponse {
       
        try {
            $feature = Feature::get();
            return $this->successResponse($feature, "Data Found");
        } catch (\Exception $ex) {
            return $this->errorResponse($ex);
        }
    }
}