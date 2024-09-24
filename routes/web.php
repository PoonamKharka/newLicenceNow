<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\LearnerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\PaymentPolicyController;
use App\Http\Controllers\PrivacyPolicyController;
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

Route::middleware(['auth', 'admin.gate:admin-access'])->group( function () {
    Route::get('admin-dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::resource('users', RegisterController::class);
    Route::resource('instructors', InstructorController::class);
    Route::resource('learners', LearnerController::class);
    Route::resource('faqs', FaqController::class);
    Route::resource('aboutus', AboutUsController::class);
    Route::resource('privacy',PrivacyPolicyController::class);
    Route::resource('payment',PaymentPolicyController::class);

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});