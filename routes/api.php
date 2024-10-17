<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegistrationController;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\SearchController;
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

// Route::get('docs', function () {
//     return view('swagger');
// });

# Authentication Route
Route::post('instructor-register', [RegistrationController::class, 'instructorRegistration']);
Route::post('register', [RegistrationController::class, 'registration']);
Route::post('login', [RegistrationController::class, 'login']);

# public wesite apis
Route::middleware('auth:api')->group( function() {
    Route::get('about', [ArticleController::class, 'getDataOfAboutUs']);
    Route::get('faqs', [ArticleController::class, 'getAllFaqs']);
    Route::get('articles-data', [ArticleController::class, 'getAllArticleModules']);
    Route::get('features', [ArticleController::class, 'getAllFeatures']);
    Route::get('article/privacy-policies',[ArticleController::class,'getAllPrivacyPolicies']);
    Route::get('nav-menu',[ArticleController::class,'getAllMenu']);
    Route::get('instructor-search',[SearchController::class,'getAvailableInstructors']);
    Route::get('instructors',[SearchController::class,'getAllInstructors']);
    Route::get('location-search',[SearchController::class,'getAvailableSuburbs']);
    Route::get('instructors/{id}',[SearchController::class,'getInstructorDetails']);
});