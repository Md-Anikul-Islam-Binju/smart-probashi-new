<?php

use App\Http\Controllers\RecruitingAgency\ApplicationHistoryController;
use App\Http\Controllers\RecruitingAgency\BmetRegistrationController;
use App\Http\Controllers\RecruitingAgency\CandidateBmetRegistrationController;
use App\Http\Controllers\RecruitingAgency\DownloadClearanceController;
use App\Http\Controllers\RecruitingAgency\JobManagementController;
use App\Http\Controllers\RecruitingAgency\NewCandidateRegisterController;
use App\Http\Controllers\RecruitingAgency\OngoingApplicationController;
use App\Http\Controllers\RecruitingAgency\QuotaRemainingController;
use App\Http\Controllers\RecruitingAgency\RecruitingAgencyInfoController;
use App\Http\Controllers\RecruitingAgency\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecruitingAgency\DashboardController;
use App\Http\Controllers\RecruitingAgency\PdoCandidateRegistrationController;
use App\Http\Controllers\RecruitingAgency\BmetClearanceController;


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
//Verify Candidate Card
Route::get('candidate-card-verify/{id}', [DownloadClearanceController::class, 'printCandidateApplicationsVerify'])->name('candidate.card.verify');
//register for recruiting agency
Route::post('/recruiting-agency-store', [RecruitingAgencyInfoController::class, 'store'])->name('recruiting.agency.store');
// For all Recruiting Agency route
Route::group(['prefix' => 'recruiting-agency', 'namespace' => 'RecruitingAgency', 'as' => 'recruiting-agency.', 'middleware' => ['auth', 'recruiting-agency', 'prevent-back-history']], function () {
    //Dashboard
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    // Profile
    Route::get('profile', [DashboardController::class, 'profile'])->name('profile');
    // Change password
    Route::post('change/password/store', [DashboardController::class, 'changePassword'])->name('change.password');

    // personal-info
    Route::get('create-personal-info', [CandidateBmetRegistrationController::class, 'creatPersonalInfo'])->name('create.personal.info');
    Route::post('store-personal-info', [CandidateBmetRegistrationController::class, 'storePersonalInfo'])->name('store.personal.info');

    // BMET Register
    Route::get('bmet-candidate-registration-list', [CandidateBmetRegistrationController::class, 'bmetCandidateRegistrationList'])->name('bmet.candidate.registration.list');
    //After Complete Some Step and few time go again edit or update
    Route::get('bmet-registration/{type}/{id}', [CandidateBmetRegistrationController::class, 'bmetRegistration'])->name('bmet.candidate.registration.view');
    //Payment Page Show and store payment
    Route::get('payment', [CandidateBmetRegistrationController::class, 'bmetCandidateRegistrationPayment'])->name('registration.payment');
    Route::post('payment-store', [CandidateBmetRegistrationController::class, 'bmetCandidateRegistrationPaymentStore'])->name('registration.payment.store');
    //District under Upazila
    Route::get('/get-upazilas/{districtId}', [CandidateBmetRegistrationController::class, 'getUpazilas']);
    //Register Create or Update
//    Route::get('bmet-registration/{type?}/{id?}', [CandidateBmetRegistrationController::class, 'bmetRegistration'])->name('bmet.registration');
//    Route::post('bmet-registration/{type?}/{id?}', [CandidateBmetRegistrationController::class, 'bmetRegistration']);
    //Register Details
    Route::get('bmet-registration-details/{id}', [CandidateBmetRegistrationController::class, 'bmetRegistrationDetails'])->name('bmet.registration.details');


    //PDO
    Route::get('/passport-details', [PdoCandidateRegistrationController::class, 'getPassportDetails'])->name('passport.details');
    Route::get('pdo-candidate-registration-list', [PdoCandidateRegistrationController::class, 'pdoCandidateRegistrationList'])->name('pdo.candidate.registration.list');
    //PDO Candidate Registration
    Route::get('pdo-registration/{type?}/{id?}', [PdoCandidateRegistrationController::class, 'pdoRegistration'])->name('pdo.registration');
    Route::post('pdo-registration/{type?}/{id?}', [PdoCandidateRegistrationController::class, 'pdoRegistration']);
    //Schedule under ttc
    Route::get('/get-schedule/{ttcId}', [PdoCandidateRegistrationController::class, 'getSchedule']);
    //Payment Page Show and store payment
    Route::get('pdo-payment/{pdoId}', [PdoCandidateRegistrationController::class, 'pdoCandidateRegistrationPayment'])->name('pdo.registration.payment');
    Route::post('pdo-payment-store', [PdoCandidateRegistrationController::class, 'pdoCandidateRegistrationPaymentStore'])->name('pdo.registration.payment.store');
    Route::get('pdo-candidate-card-download-list', [PdoCandidateRegistrationController::class, 'pdoCandidateDownloadCardList'])->name('pdo.candidate.card.download.list');

    // BMET Clearance
    Route::get('new-applications', [BmetClearanceController::class, 'bmetClearance'])->name('new.applications');
    Route::get('ra-ongoing-application', [BmetClearanceController::class, 'ongoingApplications'])->name('ongoing.applications');


    //Attached Job Management
    Route::get('job-list', [JobManagementController::class, 'index'])->name('job.list');
    Route::get('job/create', [JobManagementController::class, 'create'])->name('job.create');
    Route::post('job/store', [JobManagementController::class, 'store'])->name('job.store');
    Route::get('job/show/{id}', [JobManagementController::class, 'show'])->name('job.show');
    Route::get('job/edit/{id}', [JobManagementController::class, 'edit'])->name('job.edit');
    Route::post('job/update/{id}', [JobManagementController::class, 'update'])->name('job.update');
    Route::get('all-applications/{id}', [JobManagementController::class, 'jobApplications'])->name('all.applications');
    Route::get('shortlisted-applications/{id}', [JobManagementController::class, 'jobApplicationsShortlisted'])->name('shortlisted.applications');
    Route::get('selected-applications/{id}', [JobManagementController::class, 'jobApplicationsSelected'])->name('selected.applications');
    //Skill Search Job Management
    Route::get('skill/job/create', [JobManagementController::class, 'createSkillJob'])->name('skill.job.create');
    Route::post('skill/job/store', [JobManagementController::class, 'storeSkillJob'])->name('skill.job.store');
    Route::post('skill/job/update/{id}', [JobManagementController::class, 'updateSkillJob'])->name('skill.job.update');
    //Attached Job
    Route::post('job/attached', [JobManagementController::class, 'attachedJob'])->name('job.attached');
    Route::get('job/published/{id}', [JobManagementController::class, 'publishedJob'])->name('job.published');
    Route::get('job/unpublished/{id}', [JobManagementController::class, 'unpublishedJob'])->name('job.unpublished');
    //Select Candidate || all job application
    Route::get('all-job-applications', [JobManagementController::class, 'allJobApplications'])->name('all.job.applications');
    //Recruitment Permission Malaysia
    Route::get('recruitment-permission-malaysia', [JobManagementController::class, 'recruitmentPermissionMalaysia'])->name('recruitment.permission.malaysia');
    //All Application By Register Candidate
    Route::get('all-application-by-register-candidate', [JobManagementController::class, 'allApplicationByRegisterCandidate'])->name('all.application.by.register.candidate');


    //New Candidate Register
    Route::get('new-candidate-register', [NewCandidateRegisterController::class, 'newCandidateRegister'])->name('new.candidate.register');
    Route::post('new-candidate-register-info-store', [NewCandidateRegisterController::class, 'newCandidateRegisterInfoStore'])->name('new.candidate.register.info.store');
    //My Databank
    Route::get('my-data-banks', [NewCandidateRegisterController::class, 'myDataBank'])->name('my.data.bank');
    //Talent Pool Search or Skill Search
    Route::get('talent-skill-search', [SearchController::class, 'skillSearch'])->name('talent.skill.search');
    Route::get('talent-skill-search-result', [SearchController::class, 'skillSearchResult'])->name('talent.skill.search.result');

    //Malaysia Candidate Search
    Route::get('malaysia-candidate-search', [SearchController::class, 'malaysiaCandidateSearch'])->name('malaysia.candidate.search');
    Route::get('malaysia-candidate-search-result', [SearchController::class, 'malaysiaCandidateSearchResult'])->name('malaysia.candidate.search.result');



    //BMET Clearance
    Route::get('bmet-clearance-new-application',[BmetClearanceController::class, 'bmetClearanceNewApplication'])->name('bmet.clearance.new.application');
    Route::post('bmet-clearance-new-application-info-store',[BmetClearanceController::class, 'bmetClearanceNewApplicationInfoStore'])->name('bmet.clearance.new.application.info.store');
    Route::get('bmet-clearance-application-step/{id}',[BmetClearanceController::class, 'bmetClearanceApplicationStep'])->name('bmet.clearance.application.step');
    Route::post('bmet-clearance-application-step-job-clearance-store',[BmetClearanceController::class, 'bmetClearanceApplicationStepJobClearance'])->name('bmet.clearance.application.step.job.clearance.store');
    Route::put('bmet-clearance-application-step-job-clearance-update/{id}',[BmetClearanceController::class, 'updateBmetClearanceApplicationStepJobClearance'])->name('bmet.clearance.application.step.job.clearance.update');
    Route::get('bmet-clearance-application-step-job-clearance-delete/{id}',[BmetClearanceController::class, 'destroyBmetClearanceApplicationStepJobClearance'])->name('bmet.clearance.application.step.job.clearance.delete');
    Route::get('/passport-details-for-clearance', [BmetClearanceController::class, 'getPassportDetailsForClearance'])->name('passport.details.for.clearance');
    Route::get('/passport-details-for-clearance-add-candidate', [BmetClearanceController::class, 'getPassportDetailsForClearanceAddCandidate'])->name('passport.details.for.clearance.add.candidate');
    Route::post('bmet-candidate-clearance-application-step-store',[BmetClearanceController::class, 'bmetClearanceApplicationStepCandidateClearance'])->name('bmet.candidate.clearance.application.step.store');

    //Clearance Payment
    Route::get('clearance-payment/{id}', [BmetClearanceController::class, 'clearancePayment'])->name('clearance.payment');
    Route::post('clearance-payment-store', [BmetClearanceController::class, 'clearancePaymentStore'])->name('clearance.payment.store');

    //Ongoing Application
    Route::get('ongoing-application', [OngoingApplicationController::class, 'ongoingApplication'])->name('ongoing.application');
    Route::get('ongoing-application-step/{id}', [OngoingApplicationController::class, 'ongoingApplicationStep'])->name('ongoing.application.step');

    //Quota Remaining
    Route::get('quota-remaining', [QuotaRemainingController::class, 'quotaRemaining'])->name('quota.remaining');

    //Pull Job Store
    Route::post('pull-job-store',[BmetClearanceController::class, 'pullJobStore'])->name('pull.job.store');

    //Application History
    Route::get('application-history', [ApplicationHistoryController::class, 'applicationHistory'])->name('application.history');
    Route::get('application-history-step/{id}', [ApplicationHistoryController::class, 'applicationHistoryStep'])->name('application.history.step');


    //Download BMET Clearance
    Route::get('download-applications', [DownloadClearanceController::class, 'downloadApplication'])->name('download.applications');
    Route::get('download-applications-candidate/{id}', [DownloadClearanceController::class, 'downloadApplicationCandidate'])->name('download.applications.candidate');
    Route::get('print-candidate-applications/{id}', [DownloadClearanceController::class, 'printCandidateApplications'])->name('print.candidate.applications');
    Route::get('download-candidate-card/{id}',[DownloadClearanceController::class, 'downloadCandidateCard'])->name('download.candidate.card');



    #=========================================BMET REGISTRATION==============================================
    Route::get('bmet-registration', [BmetRegistrationController::class, 'create'])->name('bmet.create');
    Route::post('/passport', [BmetRegistrationController::class, 'passport'])->name('passport.store');
    Route::post('/personal', [BmetRegistrationController::class, 'personal'])->name('personal.store');
    Route::post('/contact', [BmetRegistrationController::class, 'contact'])->name('contact.store');
    Route::post('/nominee', [BmetRegistrationController::class, 'nominee'])->name('nominee.store');
    Route::post('/education', [BmetRegistrationController::class, 'education'])->name('education.store');
    Route::post('/get/passport-info', [BmetRegistrationController::class, 'getPassportInfo'])->name('passport.info');
});


