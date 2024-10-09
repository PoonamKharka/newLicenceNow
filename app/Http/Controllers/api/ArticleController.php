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
     *     path="/api/articles-data?features=true&learnerTC=true&instructorTC=true&paymentPolicy=true",
     *     summary="Get all article modules based on parameters( 1.Features 2.Learner Terms and Conditions 3.Instructor Terms and Conditions 4.Privacy Policy 5.Payment Policy )",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function getAllArticleModules(Request $request): JsonResponse
    {
        $responseData = [];
        try {
            if ($request->has('features')) {
                $responseData['features'] = Feature::get();
            }
            if ($request->has('learnerTC')) {
                $responseData['learnerTC'] = LearnerTermsAndCondition::get();
            }
            if ($request->has('instructorTC')) {
                $responseData['instructorTC'] = InstructorTermsAndCondition::get();
            }
            if ($request->has('paymentPolicy')) {
                $responseData['paymentPolicy'] = PaymentPolicyArticle::get();
            }
            return $this->successResponse($responseData, "Data Found");
        }catch (\Exception $ex) {
            return $this->errorResponse($ex);
        }
    }
    
    /**
     * @OA\Get(
     *     path="/api/about",
     *     summary="Get About us page data",
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
    /**
     * @OA\Get(
     *     path="/api/article/privacy-policies",
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