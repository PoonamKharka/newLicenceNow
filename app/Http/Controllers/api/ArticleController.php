<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\JsonResponse;
use App\Models\AboutUs;
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
}
