<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\RegisterController;
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

Route::post('login', [LoginController::class, 'login']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('admin-dashboard', function () {
        return view('admin.dashboard');
    });
    Route::resource('users', RegisterController::class);
    Route::get('instructor-index', [InstructorController::class, 'index'])->name('instructor-index');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});


