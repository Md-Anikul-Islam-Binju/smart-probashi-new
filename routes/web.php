<?php

use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\BmetRegistrationController;
use App\Http\Controllers\Admin\BoardController;
use App\Http\Controllers\Admin\ClearanceController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\EducationLevelController;
use App\Http\Controllers\Admin\HospitalController;
use App\Http\Controllers\Admin\JobCategoryController;
use App\Http\Controllers\Admin\JobManagementController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\OrganizationController;
use App\Http\Controllers\Admin\PdoManagementController;
use App\Http\Controllers\Admin\RecruitingAgencyController;
use App\Http\Controllers\Admin\RelationController;
use App\Http\Controllers\Admin\ReligionController;
use App\Http\Controllers\Admin\UpazillaController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TtcRegistrationController;
use App\Http\Controllers\Admin\TrainingScheduleController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('auth.login');
});

// For system reboot
Route::get('/reboot', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    file_put_contents(storage_path('logs/laravel.log'), '');
    Artisan::call('key:generate');
    Artisan::call('config:cache');
    Artisan::call('optimize');
    return '<center><h1>System Rebooted!</h1></center>';
});


// For Admin all route
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin', 'prevent-back-history']], function (){

    //Dashboard
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Profile
    Route::get('profile', [DashboardController::class, 'profile'])->name('profile');
    // Change password
    Route::post('change/password/3store', [DashboardController::class, 'changePassword'])->name('change.password');

    // Clearance
    Route::get('clearance', [ClearanceController::class, 'clearance'])->name('clearance');
    Route::get('clearance-sign/{id}', [ClearanceController::class, 'applicationSign'])->name('clearance.sign');
    Route::post('clearance-sign-update/{id}', [ClearanceController::class, 'applicationSignUpdate'])->name('clearance.sign.update');

    //Division
    Route::get('/division',[DivisionController::class, 'index'])->name('division');
    Route::post('/division/store',[DivisionController::class, 'store'])->name('division.store');
    Route::put('/division/update/{id}',[DivisionController::class, 'update'])->name('division.update');
    Route::get('/division/delete/{id}',[DivisionController::class, 'destroy'])->name('division.delete');

    //District
    Route::get('/district',[DistrictController::class, 'index'])->name('district');
    Route::post('/district/store',[DistrictController::class, 'store'])->name('district.store');
    Route::put('/district/update/{id}',[DistrictController::class, 'update'])->name('district.update');
    Route::get('/district/delete/{id}',[DistrictController::class, 'destroy'])->name('district.delete');

    //Upazilla
    Route::get('/upazila',[UpazillaController::class, 'index'])->name('upazila');
    Route::post('/upazila/store',[UpazillaController::class, 'store'])->name('upazila.store');
    Route::put('/upazila/update/{id}',[UpazillaController::class, 'update'])->name('upazila.update');
    Route::get('/upazila/delete/{id}',[UpazillaController::class, 'destroy'])->name('upazila.delete');

    //Organization
    Route::get('/organization',[OrganizationController::class, 'index'])->name('organization');
    Route::post('/organization/store',[OrganizationController::class, 'store'])->name('organization.store');
    Route::put('/organization/update/{id}',[OrganizationController::class, 'update'])->name('organization.update');
    Route::get('/organization/delete/{id}',[OrganizationController::class, 'destroy'])->name('organization.delete');

    //Religion
    Route::get('/religion',[ReligionController::class, 'index'])->name('religion');
    Route::post('/religion/store',[ReligionController::class, 'store'])->name('religion.store');
    Route::put('/religion/update/{id}',[ReligionController::class, 'update'])->name('religion.update');
    Route::get('/religion/delete/{id}',[ReligionController::class, 'destroy'])->name('religion.delete');

    //Job Category
    Route::get('/job-category',[JobCategoryController::class, 'index'])->name('job.category');
    Route::post('/job-category/store',[JobCategoryController::class, 'store'])->name('job.category.store');
    Route::put('/job-category/update/{id}',[JobCategoryController::class, 'update'])->name('job.category.update');
    Route::get('/job-category/delete/{id}',[JobCategoryController::class, 'destroy'])->name('job.category.delete');

    //Board
    Route::get('/board',[BoardController::class, 'index'])->name('board');
    Route::post('/board/store',[BoardController::class, 'store'])->name('board.store');
    Route::put('/board/update/{id}',[BoardController::class, 'update'])->name('board.update');
    Route::get('/board/delete/{id}',[BoardController::class, 'destroy'])->name('board.delete');

    //Education Level
    Route::get('/education-level',[EducationLevelController::class, 'index'])->name('education.level');
    Route::post('/education-level/store',[EducationLevelController::class, 'store'])->name('education.level.store');
    Route::put('/education-level/update/{id}',[EducationLevelController::class, 'update'])->name('education.level.update');
    Route::get('/education-level/delete/{id}',[EducationLevelController::class, 'destroy'])->name('education.level.delete');

    //Language
    Route::get('/language',[LanguageController::class, 'index'])->name('language');
    Route::post('/language/store',[LanguageController::class, 'store'])->name('language.store');
    Route::put('/language/update/{id}',[LanguageController::class, 'update'])->name('language.update');
    Route::get('/language/delete/{id}',[LanguageController::class, 'destroy'])->name('language.delete');

    //Currency
    Route::get('/currency',[CurrencyController::class, 'index'])->name('currency');
    Route::post('/currency/store',[CurrencyController::class, 'store'])->name('currency.store');
    Route::put('/currency/update/{id}',[CurrencyController::class, 'update'])->name('currency.update');
    Route::get('/currency/delete/{id}',[CurrencyController::class, 'destroy'])->name('currency.delete');

    //Relation
    Route::get('/relation',[RelationController::class, 'index'])->name('relation');
    Route::post('/relation/store',[RelationController::class, 'store'])->name('relation.store');
    Route::put('/relation/update/{id}',[RelationController::class, 'update'])->name('relation.update');
    Route::get('/relation/delete/{id}',[RelationController::class, 'destroy'])->name('relation.delete');

    //BMET Registration
    Route::get('/bmet', [BmetRegistrationController::class, 'index'])->name('bmet');
    Route::post('/bmet/store', [BmetRegistrationController::class, 'store'])->name('bmet.store');
    Route::put('/bmet/update/{id}', [BmetRegistrationController::class, 'update'])->name('bmet.update');
    Route::get('/bmet/delete/{id}', [BmetRegistrationController::class, 'destroy'])->name('bmet.delete');
    //BMET Candidate Registration List
    Route::get('/bmet/candidate-registered-verification', [BmetRegistrationController::class, 'registeredVerificationCandidateList'])->name('bmet.candidate.registered.verification');
    Route::get('/bmet/candidate-registered-details/{id}', [BmetRegistrationController::class, 'registeredCandidateDetails'])->name('bmet.candidate.registered.details');
    Route::get('registered-verification-approved/{id}', [BmetRegistrationController::class, 'registeredVerificationApproved'])->name('candidate.registered.verification.approved');
    Route::get('registered-verification-not-approved/{id}', [BmetRegistrationController::class, 'registeredVerificationNotApproved'])->name('candidate.registered.verification.not.approved');

    //Recruiting Agency approved list
    Route::get('/recruiting-agency/all',[RecruitingAgencyController::class, 'all'])->name('recruiting.agency.all');
    Route::get('/recruiting-agency/approved',[RecruitingAgencyController::class, 'approved'])->name('recruiting.agency.approved');
    Route::get('/recruiting-agency/pending',[RecruitingAgencyController::class, 'pending'])->name('recruiting.agency.pending');
    Route::get('/recruiting-agency/rejected',[RecruitingAgencyController::class, 'rejected'])->name('recruiting.agency.rejected');

    //Recruiting Agency approved & reject
    Route::get('/recruiting-agency/approved/{id}',[RecruitingAgencyController::class, 'approvedRecruitingAgency'])->name('agency.approved');
    Route::get('/recruiting-agency/reject/{id}',[RecruitingAgencyController::class, 'rejectRecruitingAgency'])->name('agency.reject');
    //Recruiting Agency Data Show
    Route::get('/recruiting-agency/show/{id}',[RecruitingAgencyController::class, 'show'])->name('recruiting.agency.show');

    //Job Management
    Route::get('/job-management',[JobManagementController::class, 'index'])->name('job.management');
    Route::get('/job-details/{id}',[JobManagementController::class, 'show'])->name('job.details');
    Route::get('/job-transfer/{id}',[JobManagementController::class, 'jobTransfer'])->name('job.transfer');

    // TTC Registration
    Route::get('/ttc',[TtcRegistrationController::class, 'index'])->name('ttc');
    Route::get('get-districts/{divisionId}', [TtcRegistrationController::class,'getDistricts']);
    Route::get('get-upazillas/{districtId}', [TtcRegistrationController::class,'getUpazillas']);
    Route::post('/ttc/store',[TtcRegistrationController::class, 'storeTTC'])->name('ttc.store');
    Route::put('/ttc/update/{id}',[TtcRegistrationController::class, 'updateTTC'])->name('ttc.update');
    Route::get('/ttc/delete/{id}',[TtcRegistrationController::class, 'destroyTTC'])->name('ttc.delete');

    // TTC Schedule
    Route::get('/ttc-schedule',[TrainingScheduleController::class, 'index'])->name('ttc.schedule');
    Route::post('/ttc-schedule/store',[TrainingScheduleController::class, 'storeSchedule'])->name('ttc.schedule.store');
    Route::put('/ttc-schedule/update/{id}',[TrainingScheduleController::class, 'updateSchedule'])->name('ttc.schedule.update');

    //Pdo Management
    Route::get('/pdo-register-candidate-list',[PdoManagementController::class, 'pdoRegisterCandidateList'])->name('pdo.register.candidate.list');
    Route::get('/pdo-register-candidate-details/{id}',[PdoManagementController::class, 'pdoRegisterCandidateDetails'])->name('pdo.register.candidate.details');
    Route::get('pdo-registered-verification-approved/{id}',[PdoManagementController::class, 'pdoRegisteredVerificationApproved'])->name('pdo.candidate.registered.verification.approved');
    Route::get('pdo-registered-verification-not-approved/{id}',[PdoManagementController::class, 'pdoRegisteredVerificationNotApproved'])->name('pdo.candidate.registered.verification.not.approved');

    //Bank
    Route::get('/bank',[BankController::class, 'index'])->name('bank');
    Route::post('/bank/store',[BankController::class, 'store'])->name('bank.store');
    Route::put('/bank/update/{id}',[BankController::class, 'update'])->name('bank.update');
    Route::get('/bank/delete/{id}',[BankController::class, 'destroy'])->name('bank.delete');

    //Hospital
    Route::get('/hospital',[HospitalController::class, 'index'])->name('hospital');
    Route::post('/hospital/store',[HospitalController::class, 'store'])->name('hospital.store');
    Route::put('/hospital/update/{id}',[HospitalController::class, 'update'])->name('hospital.update');
    Route::get('/hospital/delete/{id}',[HospitalController::class, 'destroy'])->name('hospital.delete');


});










// For external route Recruiting Agency & BMET
require __DIR__ . '/recruiting_agency.php';
require __DIR__ . '/bmet.php';
require __DIR__ . '/foreign_ministry.php';


Auth::routes([
    'reset' => false, // Reset Password Routes...
    'verify' => false, // Email Verification Routes...
]);

/*Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');*/
