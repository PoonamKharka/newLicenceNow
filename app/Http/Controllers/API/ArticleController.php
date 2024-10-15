<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\JsonResponse;
use App\Models\AboutUs;
use App\Models\Faq;
use App\Models\Feature;
use App\Models\LearnerTermsAndCondition;
use App\Models\InstructorTermsAndCondition;
use App\Models\PaymentPolicyArticle;
use App\Models\PrivacyPolicyArticle;
use App\Models\NavMenu;
use Illuminate\Support\Facades\Auth;

class ArticleController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/api/about",
     *     tags={"Articles"},
     *     summary="About Us",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
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
     *     tags={"Articles"},
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
     *     tags={"Articles"},
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
    /**
     * @OA\Get(
     *     path="/api/article/privacy-policies",
     *     tags={"Articles"},
     *     summary="Get all article privacy policies",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function getAllPrivacyPolicies(): JsonResponse {
       
        try {
            $privacyPolicyArticle = PrivacyPolicyArticle::get();
            return $this->successResponse($privacyPolicyArticle, "Data Found");
        } catch (\Exception $ex) {
            return $this->errorResponse($ex);
        }
    }
    
    /**
     * @OA\Get(
     *     path="/api/nav-menu",
     *     tags={"Articles"},
     *     summary="Get all menu items",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function getAllMenu(): JsonResponse {
       
        try {
            $navMenu = NavMenu::get();
            return $this->successResponse($navMenu, "Data Found");
        } catch (\Exception $ex) {
            return $this->errorResponse($ex);
        }
    }
}