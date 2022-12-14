<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Install\InstallController;
use App\Http\Controllers\Auth\LoginController;

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

Route::middleware(['install'])->group(function () {

    Auth::routes(['register' => false]);

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware(['auth'])->group(function () {

        Route::get('/dashboard', function(){
            return view('dashboard');
        });

    });

});

Route::get('/installation', [InstallController::class, 'index']);
Route::get('/install/database', [InstallController::class, 'database']);
Route::post('/install/process_install', [InstallController::class, 'process_install']);
Route::get('/install/create_user', [InstallController::class, 'create_user']);
Route::post('/install/store_user', [InstallController::class, 'store_user']);
Route::get('/install/system_settings', [InstallController::class, 'system_settings']);
Route::post('/install/finish', [InstallController::class, 'final_touch']);