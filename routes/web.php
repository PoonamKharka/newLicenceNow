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
use App\Http\Controllers\auth\ForgotPasswordController;
use App\Http\Controllers\NavMenuController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\FAQContentController;
use App\Http\Controllers\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
Route::get('/admin', [LoginController::class, 'index']);

Route::prefix('admin')->group(function(){
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    //Rest the password
    Route::middleware(['web'])->group(function () {
        Route::get('password/forgot', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.forgot');
        Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('password/reset', [ForgotPasswordController::class, 'reset'])->name('password.update');
    });
    Route::middleware(['auth', 'admin.gate:admin-access'])->group(function () {
        // Route::get('admin-dashboard', function () {
        //     return view('admin.dashboard');
        // })->name('dashboard');

        Route::get('admin-dashboard',[DashboardController::class, 'index'])->name('dashboard');

        Route::resource('users', RegisterController::class);
        Route::resource('instructors', InstructorController::class);
        Route::post('/validate-phone', [InstructorController::class, 'validatePhone']);
        Route::post('/validate-salary-pay-mode', [InstructorController::class, 'validateSalaryPayModeId']);
        Route::resource('testpackages', TestPackageController::class);
        Route::resource('articles', ArticleController::class);
        Route::resource('learners', LearnerController::class);
        Route::resource('faqs', FaqController::class);
        Route::resource('faqContent', FAQContentController::class);
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
        Route::resource('nav-menu',NavMenuController::class);
        Route::get('instructor-request',[InstructorController::class, 'getAllInstructorsRquest'])->name('instructor-request');
        Route::get('instructor-request/{id}',[InstructorController::class, 'updateInstructorsRquest'])->name('instructor-request.edit');
        Route::post('instructor-request/update-status', [InstructorController::class, 'updateInstructorStatus'])->name('instructor-request.update-status');
        Route::get('instructor-request-show/{id}',[InstructorController::class, 'showInstructorRequest'])->name('instructor-request.view');
        Route::post('update-attachments/{id}',[InstructorController::class, 'updateAttachments'])->name('admin.instructor.update-attachments');
        Route::get('user-profile/{id}',[RegisterController::class, 'userProfile'])->name('user-profile');
        Route::resource('informations', InformationController::class);
        Route::get('locations/search',[InstructorController::class, 'searchLocations'])->name('locations.search');
        Route::get('locations/{id}', [InstructorController::class, 'getLocationById']);
    });
});