<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegistrationController;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\SearchController;
use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\CommanAPIController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/documentation', function () {
    return view('vendor.l5-swagger.index');
});

Route::group(['middleware' => 'cors'], function() {
   # Authentication Route
    Route::post('instructor-register', [RegistrationController::class, 'instructorRegistrationRquest']);
    Route::post('register', [RegistrationController::class, 'registration']);
    Route::post('login', [RegistrationController::class, 'login']);

    # public website apis
    /** Article endpoints starts */
    Route::get('about', [ArticleController::class, 'getDataOfAboutUs']);
    Route::get('faqs', [ArticleController::class, 'getAllFaqs']);
    Route::get('articles-data', [ArticleController::class, 'getAllArticleModules']);
    Route::get('features', [ArticleController::class, 'getAllFeatures']);
    Route::get('article/privacy-policies',[ArticleController::class,'getAllPrivacyPolicies']);
    Route::get('nav-menu',[ArticleController::class,'getAllMenu']);
    /** Article endpoints ends */

    /** Home Page endpoints starts */
    Route::get('instructor-search',[SearchController::class,'getAvailableInstructors']);
    Route::get('instructors',[SearchController::class,'getAllInstructors']);
    Route::get('location-search',[SearchController::class,'getAvailableSuburbs']);
    Route::get('instructors/{id}',[SearchController::class,'getInstructorDetails']);
    /** Home Page endpoints ends */

    /** Booking steps endpoints starts */
    Route::get('prices',[BookingController::class,'getHoursList']);
    Route::get('test-package', [BookingController::class, 'getTestPackage']);
    Route::get('pricing-structure', [BookingController::class, 'pricingStructure']);
    /** Booking steps endpoints ends */

    /** Common APIs starts */
    Route::get('states', [CommanAPIController::class, 'getStates']);
    /** Common APIs ends */ 
});
