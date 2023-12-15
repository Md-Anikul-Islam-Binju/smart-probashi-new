<?php

use App\Http\Controllers\BMET\RegisteredCandidateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BMET\DashboardController;


/*
|--------------------------------------------------------------------------
| BMET Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




// For all BMET route
Route::group(['prefix' => 'bmet', 'namespace' => 'BMET', 'as' => 'bmet.', 'middleware' => ['auth', 'bmet', 'prevent-back-history']], function (){

    //Dashboard
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Profile
    Route::get('profile', [DashboardController::class, 'profile'])->name('profile');
    // Change password
    Route::post('change/password/store', [DashboardController::class, 'changePassword'])->name('change.password');

    //registered completed candidate list
    Route::get('registered-completed-candidate-list', [RegisteredCandidateController::class, 'registeredCompletedCandidateList'])->name('registered.completed.candidate.list');
    Route::get('candidate-registered-details/{id}',[RegisteredCandidateController::class, 'bmetRegisteredCandidateDetails'])->name('candidate.registered.details');
    Route::get('registered-approved/{id}',[RegisteredCandidateController::class, 'registeredApproved'])->name('registered.approved');
    Route::get('registered-not-approved/{id}',[RegisteredCandidateController::class, 'registeredNotApproved'])->name('registered.not.approved');

});
