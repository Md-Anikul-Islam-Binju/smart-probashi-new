<?php

namespace App\Http\Controllers\RecruitingAgency;

use App\Http\Controllers\Controller;
use App\Models\admin\Bank;
use App\Models\admin\Currency;
use App\Models\admin\Hospital;
use App\Models\admin\JobCategory;
use App\Models\RecruitingAgency\BankInfo;
use App\Models\RecruitingAgency\CandidateClearance;
use App\Models\RecruitingAgency\CandidatePassportInfo;
use App\Models\RecruitingAgency\Clearance;
use App\Models\RecruitingAgency\ClearancePayment;
use App\Models\RecruitingAgency\JobClearance;
use App\Models\RecruitingAgency\JobManagement;
use App\Models\RecruitingAgency\MedicalInfo;
use App\Models\RecruitingAgency\VisaInfo;
use FontLib\Table\Type\cmap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Toastr;
class BmetClearanceController extends Controller
{
    public function bmetClearanceNewApplication()
	{
        $country = Currency::all();
        $clearance = Clearance::where('recruiting_agency_id',Auth::id())->with('country','candidateClearances','jobClearances.jobManagement')->latest()->get();
        return view('recruitingAgency.pages.bmetClearance.new_applications',compact('country','clearance'));
	}

    public function bmetClearanceNewApplicationInfoStore(Request $request)
    {
        try {
            $request->validate([
                'country_id' => 'required',
            ]);
            $applicationNo = 'CL-' . now()->format('ymdHis');
            $clearance = Clearance::create([
                'recruiting_agency_id' => Auth::id(),
                'country_id' => $request->input('country_id'),
                'clearance_type' => $request->input('clearance_type'),
                'application_no' => $applicationNo,
                'status' => 1,
            ]);
            Toastr::success('Clearance Process start successfully!', 'Success');
            return redirect()->route('recruiting-agency.bmet.clearance.application.step',$clearance->id);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

    }

    public function bmetClearanceApplicationStep(Request $request, $id)
    {


        $banks = Bank::latest()->get();
        $hospital = Hospital::latest()->get();
        $clearance = Clearance::where('id',$id)->with('country',
                    'jobClearances.jobManagement',
                    'jobClearances.jobManagement.jobCategory',
                    'candidateClearances.passportInfo',
                    'candidateClearances.passportInfo.verificationInfo',
                    'candidateClearances.passportInfo.pdoInfo',
                    'candidateClearances.passportInfo.visaInfo',
                    'candidateClearances.job',
                    'candidateClearances.job.jobCategory',
                    'candidateClearancePayment')
                    ->first();
        $jobCategory = JobCategory::latest()->get();
        $currency = Currency::latest()->get();
        $pullJobs = JobManagement::where('recruiting_agencies_id', Auth::id())
                    ->where('no_of_post_already_finished', '>', 0)
                    ->where('country_id',$clearance->country_id)
                    ->where('status',3)
                    ->with('jobCategory','country')
                    ->get();
        return view('recruitingAgency.pages.bmetClearance.new_clearance_step',compact('clearance','jobCategory','currency','banks','hospital','pullJobs'));
    }

    public function bmetClearanceApplicationStepJobClearance(Request $request)
    {

        $request->validate([
            'employee_name' => 'required',
            'category_id' => 'required',
            'skill_type' => 'required',
            'no_of_post' => 'required',
            'salary_amount' => 'required',
            'currency_id' => 'required',
            'salary_per' => 'required',
            'contract_tenure' => 'required',
            'gender' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $jobProof = 'job/employmentPermit/';
            $employmentContract ='job/workAgreement/';
            $mailFrom = 'job/other/';
            if ($request->hasFile('employment_permit_file')) {
                $jobProof = $request->file('employment_permit_file')->store($jobProof, 'public');
            } else {
                $jobProof = null;
            }
            if ($request->hasFile('work_agreement_file')) {
                $employmentContract = $request->file('work_agreement_file')->store($employmentContract, 'public');
            } else {
                $employmentContract = null;
            }
            if ($request->hasFile('other_file')) {
                $mailFrom = $request->file('other_file')->store($mailFrom, 'public');
            } else {
                $mailFrom = null;
            }
            $jobInfos = JobManagement::create([
                'recruiting_agencies_id' => Auth::id(),
                'employee_name' => $request->input('employee_name'),
                'city_name' => $request->input('city_name'),
                'employer_address' => $request->input('employer_address'),
                'job_type' => $request->input('job_type'),
                'category_id' => $request->input('category_id'),
                'working_duration' => $request->input('working_duration'),
                'working_days' => $request->input('working_days'),
                'working_on' => $request->input('working_on'),
                'skill_type' => $request->input('skill_type'),
                'no_of_post' => $request->input('no_of_post'),
                'no_of_post_already_finished' => $request->input('no_of_post'),
                'salary_amount' => $request->input('salary_amount'),
                'currency_id' => $request->input('currency_id'),
                'country_id' => $request->input('currency_id'),
                'salary_per' => $request->input('salary_per'),
                'gender' => $request->input('gender'),
                'min_age' => $request->input('min_age'),
                'max_age' => $request->input('max_age'),
                'contract_tenure' => $request->input('contract_tenure'),
                'probation_period' => $request->input('probation_period'),
                'is_accommodation' => $request->input('is_accommodation'),
                'is_visa' => $request->input('is_visa'),
                'is_food' => $request->input('is_food'),
                'is_one_way' => $request->input('is_one_way'),
                'is_other' => $request->input('is_other'),
                'is_medical' => $request->input('is_medical'),
                'is_insurance' => $request->input('is_insurance'),
                'is_transport' => $request->input('is_transport'),
                'is_two_way' => $request->input('is_two_way'),
                'employment_permit_file' => $jobProof,
                'work_agreement_file' => $employmentContract,
                'other_file' => $mailFrom,
                'status' => 5,
            ]);
            $jobClearance = JobClearance::create([
                'clearance_id' => $request->input('clearance_id'),
                'job_id' => $jobInfos->id,
                'recruiting_agency_id' => Auth::id(),
                'status' => 1,
            ]);
            DB::commit();
            return redirect()->back()->with('success','Job Add Successfully Done Under Clearance!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error','An error occurred while storing data!');
        }
    }


    public function updateBmetClearanceApplicationStepJobClearance(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'employee_name' => 'required',
                'category_id' => 'required',
                'skill_type' => 'required',
                'no_of_post' => 'required',
                'salary_amount' => 'required',
                'currency_id' => 'required',
                'salary_per' => 'required',
                'contract_tenure' => 'required',
                'gender' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            // File Uploads
            $jobProof = $request->hasFile('employment_permit_file') ?
                $request->file('employment_permit_file')->store('job/employmentPermit/', 'public') :
                null;
            $employmentContract = $request->hasFile('work_agreement_file') ?
                $request->file('work_agreement_file')->store('job/workAgreement/', 'public') :
                null;
            $mailFrom = $request->hasFile('other_file') ?
                $request->file('other_file')->store('job/other/', 'public') :
                null;
            $jobInfos = JobManagement::findOrFail($id);
            $jobInfos->employee_name = $request->input('employee_name');
            $jobInfos->city_name = $request->input('city_name');
            $jobInfos->employer_address = $request->input('employer_address');
            $jobInfos->job_type = $request->input('job_type');
            $jobInfos->category_id = $request->input('category_id');
            $jobInfos->working_duration = $request->input('working_duration');
            $jobInfos->working_days = $request->input('working_days');
            $jobInfos->working_on = $request->input('working_on');
            $jobInfos->skill_type = $request->input('skill_type');
            $jobInfos->no_of_post = $request->input('no_of_post');
            $jobInfos->no_of_post_already_finished = $request->input('no_of_post');
            $jobInfos->currency_id = $request->input('currency_id');
            $jobInfos->country_id = $request->input('currency_id');
            $jobInfos->salary_amount = $request->input('salary_amount');
            $jobInfos->salary_per = $request->input('salary_per');
            $jobInfos->gender = $request->input('gender');
            $jobInfos->min_age = $request->input('min_age');
            $jobInfos->max_age = $request->input('max_age');
            $jobInfos->contract_tenure = $request->input('contract_tenure');
            $jobInfos->probation_period = $request->input('probation_period');
            $jobInfos->is_accommodation = $request->input('is_accommodation');
            $jobInfos->is_food = $request->input('is_food');
            $jobInfos->is_transport = $request->input('is_transport');
            $jobInfos->is_medical = $request->input('is_medical');
            $jobInfos->is_visa = $request->input('is_visa');
            $jobInfos->is_insurance = $request->input('is_insurance');
            $jobInfos->is_one_way = $request->input('is_one_way');
            $jobInfos->is_two_way = $request->input('is_two_way');
            $jobInfos->is_other = $request->input('is_other');

            // Update file paths only if a new file is uploaded
            if ($request->hasFile('employment_permit_file')) {
                $jobInfos->employment_permit_file = $jobProof;
            } elseif ($request->input('employment_permit_file')) {
                $jobInfos->employment_permit_file = $request->input('employment_permit_file');
            }

            if ($request->hasFile('work_agreement_file')) {
                $jobInfos->work_agreement_file = $employmentContract;
            } elseif ($request->input('work_agreement_file')) {
                $jobInfos->work_agreement_file = $request->input('work_agreement_file');
            }

            if ($request->hasFile('other_file')) {
                $jobInfos->other_file = $mailFrom;
            } elseif ($request->input('other_file')) {
                $jobInfos->other_file = $request->input('other_file');
            }
            $jobInfos->save();
            Toastr::success('Job Update Successfully Done Under Clearance!', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        }
    }


    public function destroyBmetClearanceApplicationStepJobClearance($id)
    {
        try {
            JobClearance::where('job_id', $id)->delete();
            $jobManagementRecord = JobManagement::where('id', $id)->where('status', 5)->first();
            if ($jobManagementRecord) {
                $jobManagementRecord->delete();
                Toastr::success('Job Delete Successfully Done Under Clearance!', 'Success');
            } else {
                Toastr::success('Job Delete Successfully Done Under Clearance but its also role Job Management section so main job list this job not delete!', 'Success');
            }
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->route('admin.bank')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function getPassportDetailsForClearance(Request $request)
    {

        $passportNumber = $request->input('passport_no');
        $passportDetails = CandidatePassportInfo::where('recruiting_agencies_id', auth()->id())->where('passport_no', $passportNumber)->with('verificationInfo','pdoInfo','pdoInfo.trainingCenter.trainingCenterByUser')->first();
        if ($passportDetails) {
            return response()->json($passportDetails);
        } else {
            return response()->json(['error' => 'Passport not found'], 404);
        }
    }


    public function getPassportDetailsForClearanceAddCandidate(Request $request)
    {

        $passportNumber = $request->input('passport_no');
        $passportDetails = CandidatePassportInfo::where('recruiting_agencies_id', auth()->id())->where('passport_no', $passportNumber)->with('verificationInfo','pdoInfo','pdoInfo.trainingCenter.trainingCenterByUser')->first();
        if ($passportDetails) {
            return response()->json($passportDetails);
        } else {
            return response()->json(['error' => 'Passport not found'], 404);
        }
    }

    public function bmetClearanceApplicationStepCandidateClearance(Request $request)
    {

        $request->validate([
            'visa_no' => 'required',
            'visa_issue_date' => 'required',
            'sticker_no' => 'required',
            'visa_expiry_date' => 'required',
            'visa_reference_no' => 'required',
            'account_holder_name' => 'required',
            'account_number' => 'required',
            'bank_id' => 'required',
            'hospital_id' => 'required',
            'passport_info_id' => 'required',
            'job_id' => 'required',
            'job_clearance_id' => 'required',
        ]);


        try {
            if ($request->input('pdo_approval_status') == 0)
            {
                DB::rollBack();
                return redirect()->back()->with('error', 'Complete PDO first.');
            }
            elseif ($request->input('bmet_verification_registration_no') === null)
            {
                DB::rollBack();
                return redirect()->back()->with('error', 'Complete BMET Verification first.');
            }

            $visaFile = 'candidateClearance/visaFile/';
            $employmentContractFile ='candidateClearance/employmentContractFile/';
            $bankAccountFile = 'candidateClearance/bankAccountFile/';
            $medicalClearance = 'candidateClearance/medicalClearance/';
            if ($request->hasFile('visa_file')) {
                $visaFile = $request->file('visa_file')->store($visaFile, 'public');
            } else {
                $visaFile = null;
            }
            if ($request->hasFile('employment_contract_file')) {
                $employmentContractFile = $request->file('employment_contract_file')->store($employmentContractFile, 'public');
            } else {
                $employmentContractFile = null;
            }
            if ($request->hasFile('proof_of_bank_account_file')) {
                $bankAccountFile = $request->file('proof_of_bank_account_file')->store($bankAccountFile, 'public');
            } else {
                $bankAccountFile = null;
            }
            if ($request->hasFile('medical_clearance_file')) {
                $medicalClearance = $request->file('medical_clearance_file')->store($medicalClearance, 'public');
            } else {
                $medicalClearance = null;
            }




            $applicationNo = 'CCL-' . now()->format('ymdHis');
            $candidateClearance = CandidateClearance::create([
                'recruiting_agency_id' => Auth::id(),
                'job_clearance_id' =>$request->input('job_clearance_id'),
                'application_no' =>$applicationNo,
                'job_id' =>$request->input('job_id'),
                'passport_info_id' =>$request->input('passport_info_id'),
                'status' =>1,
            ]);



            $bankClearance = BankInfo::create([
                'passport_info_id' => $request->input('passport_info_id'),
                'bank_id' => $request->input('bank_id'),
                'account_holder_name' => $request->input('account_holder_name'),
                'account_number' => $request->input('account_number'),
                'proof_of_bank_account_file' => $bankAccountFile,
                'status' => 1,
            ]);

            $medicalClearance = MedicalInfo::create([
                'passport_info_id' => $request->input('passport_info_id'),
                'hospital_id' => $request->input('hospital_id'),
                'medical_clearance_file' => $medicalClearance,
                'status' => 1,
            ]);



            $visaClearance = VisaInfo::create([
                'passport_info_id' => $request->input('passport_info_id'),
                'visa_no' => $request->input('visa_no'),
                'sticker_no' => $request->input('sticker_no'),
                'visa_reference_no' => $request->input('visa_reference_no'),
                'visa_issue_date' => $request->input('visa_issue_date'),
                'visa_expiry_date' => $request->input('visa_expiry_date'),
                'sponsor_id' => $request->input('sponsor_id'),
                'attestation_ref_no' => $request->input('attestation_ref_no'),
                'attestation_ref_date' => $request->input('attestation_ref_date'),
                'visa_file' => $visaFile,
                'employment_contract_file' => $employmentContractFile,
                'status' => 1,
            ]);


            if ($request->job_id != null) {
                $jobManagement = JobManagement::where('id', $request->job_id)->first();
                if ($jobManagement) {
                    $jobManagement->decrement('no_of_post_already_finished', 1);
                    $jobManagement->save();
                }
            }

            DB::commit();
            return redirect()->back()->with('success','Candidate Clearance Successfully Done!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error','An error occurred while storing data!');
        }
    }

    public function pullJobStore(Request $request)
    {
        // Validate the request if needed

        $selectedJobs = $request->input('selectedJobs');
        $clearanceId = $request->input('clearanceId');

        try {
            foreach ($selectedJobs as $selectedJob) {
                $jobId = $selectedJob['jobId'];
                $userId = $selectedJob['userId'];

                // Your logic to save each job ID and associate it with the user and clearance goes here
                JobClearance::create([
                    'job_id' => $jobId,
                    'recruiting_agency_id' => $userId,
                    'clearance_id' => $clearanceId,
                    'status' => 1, // Adjust this according to your logic
                ]);
            }
            //return redirect()->back()->with('success','Job Pull Successfully Done!');

            return response()->json(['success' => true, 'message' => 'Jobs added successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error adding jobs: ' . $e->getMessage()], 500);
        }
    }

    public function clearancePayment($id)
    {
        $clearance = Clearance::where('id',$id)
                    ->with('candidateClearances.passportInfo')
                    ->first();
        $candidateClearancesCount = $clearance->candidateClearances->count();
        $advanceTax = 800;
        $serviceCharge = 450;
        $welfare  = 4500;
        $totalAmount = $candidateClearancesCount * ($advanceTax + $serviceCharge + $welfare);
        return view('recruitingAgency.pages.bmetClearance.clearance_payment', compact('id','candidateClearancesCount','advanceTax','serviceCharge','welfare','totalAmount'));
    }

    public function clearancePaymentStore(Request $request)
    {
        try {
            $payment = new ClearancePayment();
            $payment->clearance_id = $request->input('clearance_id');
            $payment->advance_tax = $request->input('advance_tax');
            $payment->service_charge = $request->input('service_charge');
            $payment->insurance_fee = $request->input('insurance_fee');
            $payment->payment_status = $request->input('payment_status');
            $payment->total_candidate_payment = $request->input('total_candidate_payment');
            $payment->total_payment = $request->input('total_payment');
            $payment->payment_type = $request->input('payment_type');
            $payment->save();
            Toastr::success('Payment successfully!', 'Success');
            return redirect()->route('recruiting-agency.bmet.clearance.application.step', $request->input('clearance_id'));
        } catch (\Throwable $th) {
            Toastr::error('Something went wrong', 'Error');
            return redirect()->back();
        }

    }


}
