<?php

use App\Http\Controllers\ForeignMinistry\DashboardController;
use App\Http\Controllers\ForeignMinistry\JobManagementController;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Recruiting Agency Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/






Route::group(['prefix' => 'foreign-ministry', 'namespace' => 'ForeignMinistry', 'as' => 'foreign-ministry.', 'middleware' => ['auth', 'foreign-ministry', 'prevent-back-history']], function (){
    //Dashboard
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    //Job Management
    Route::get('/job-management',[JobManagementController::class, 'index'])->name('job.management');
    Route::get('/job-details/{id}',[JobManagementController::class, 'show'])->name('job.details');
    Route::get('/job-transfer/{id}',[JobManagementController::class, 'jobApproved'])->name('job.approved');



});


