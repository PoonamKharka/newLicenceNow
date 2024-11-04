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
use App\Models\Information;
use Illuminate\Support\Facades\Auth;
use App\Models\FaqContent;

class ArticleController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/api/articles-data",
     *     tags={"Articles"},
     *     summary="Get all article modules based on parameters",
     *     description="Retrieve a list of all modules of article based on parameters and you can pass any specific parameter to get specic module",
     *     @OA\Parameter(
     *         name="features",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="boolean"),
     *         description="Add this parameter true if you want to get features list"
     *     ),
     *     @OA\Parameter(
     *         name="learnerTC",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="boolean"),
     *         description="Add this parameter true if you want to get Learner Terms and Conditions list"
     *     ),
     * @OA\Parameter(
     *         name="instructorTC",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="boolean"),
     *         description="Add this parameter true if you want to get Instructor Terms and Conditions list"
     *     ),
     * @OA\Parameter(
     *         name="paymentPolicy",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="boolean"),
     *         description="Add this parameter true if you want to get Payment Policy list"
     *     ),
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
     * @OA\Post(
     *     path="/api/about",
     *     tags={"General"},
     *     summary="Get About us page data",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="page",
     *                     type="string"
     *                 )
	 *			)
     *        )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function getDataOfAboutUs(Request $request): JsonResponse {
       
        try {
            if( $request->page == 'home') {
                $aboutUs = AboutUs::where('page', 'Home')->get();
            } else {
                $aboutUs = AboutUs::where('page', 'about')->get();
            }
            
            return $this->successResponse($aboutUs, "Data Found");

        } catch (\Exception $ex) {
            return $this->errorResponse($ex);
        }
    }

   
    /**
     * @OA\Get(
     *     path="/api/faqs",
     *     tags={"General"},
     *     summary="Get all FAQs",
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function getAllFaqs(): JsonResponse {
       
        try {
            $faqs = Faq::all();
            return $this->successResponse($faqs, "Data Found");
        } catch (\Exception $ex) {
            return $this->errorResponse($ex);
        }
    }
    
    /**
     * @OA\Get(
     *     path="/api/informations",
     *     tags={"General"},
     *     summary="Get all Informations",
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function getAllInformations(): JsonResponse {
       
        try {
            $informations = Information::get();
            return $this->successResponse($informations, "Data Found");
        } catch (\Exception $ex) {
            return $this->errorResponse($ex);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/features",
     *     tags={"General"},
     *     summary="Get all features",
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
     *     tags={"General"},
     *     summary="Get all menu items",
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