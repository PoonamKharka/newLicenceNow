<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\LearnerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\Instructor\InstructorController;
use App\Http\Controllers\PaymentPolicyController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\TestPackageController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\FeaturesController;
use App\Http\Controllers\LearnerTermsAndConditionsController;
use App\Http\Controllers\InstructorTermsAndConditionsController;
use App\Http\Controllers\PrivacyPolicyArticleController;
use App\Http\Controllers\PaymentPolicyArticleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/admin', [LoginController::class, 'index']);

Route::post('login', [LoginController::class, 'login'])->name('login');

Route::middleware(['auth', 'admin.gate:admin-access'])->group(function () {
    Route::get('admin-dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::resource('users', RegisterController::class);
    Route::resource('instructors', InstructorController::class);
    Route::resource('testpackages', TestPackageController::class);
    Route::resource('articles', ArticleController::class);
    Route::resource('learners', LearnerController::class);
    Route::resource('faqs', FaqController::class);
    Route::resource('aboutus', AboutUsController::class);
    Route::resource('privacy',PrivacyPolicyController::class);
    Route::resource('payment',PaymentPolicyController::class);
    Route::resource('location',LocationController::class);
    Route::resource('lessons',LessonController::class);
    Route::resource('price',PricingController::class);
    Route::resource('features',FeaturesController::class);
    Route::resource('learner-terms-and-condition',LearnerTermsAndConditionsController::class);
    Route::resource('instructor-terms-and-condition',InstructorTermsAndConditionsController::class);
    Route::resource('privacy-policy-articles',PrivacyPolicyArticleController::class);
    Route::resource('payment-policy-articles',PaymentPolicyArticleController::class);
   
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});