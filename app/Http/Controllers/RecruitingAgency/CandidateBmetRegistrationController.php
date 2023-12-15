<?php

namespace App\Http\Controllers\RecruitingAgency;

use App\Http\Controllers\Controller;
use App\Models\admin\Board;
use App\Models\admin\Currency;
use App\Models\admin\District;
use App\Models\admin\EducationLevel;
use App\Models\admin\JobCategory;
use App\Models\admin\Language;
use App\Models\admin\Relation;
use App\Models\admin\Religion;
use App\Models\admin\Upazilla;
use App\Models\RecruitingAgency\BmetCandidateContactInfo;
use App\Models\RecruitingAgency\BmetCandidateNomineeInfo;
use App\Models\RecruitingAgency\BmetCandidatePayment;
use App\Models\RecruitingAgency\BmetCandidatePersonalInfo;
use App\Models\RecruitingAgency\BmetCandidateQualificationInfo;
use App\Models\RecruitingAgency\BmetCandidateVerificationInfo;
use App\Models\RecruitingAgency\CandidatePassportInfo;
use App\Models\RecruitingAgency\JobManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Toastr;
class CandidateBmetRegistrationController extends Controller
{
    protected string $dir = 'recruitingAgency.pages.bmetRegistration';
    public function bmetCandidateRegistrationList(Request $request)
    {
        $passportInfos = CandidatePassportInfo::where('recruiting_agencies_id', auth()->id())->with('verificationInfo')->latest()->get();
        return view('recruitingAgency.pages.bmetRegistration.bmet_candidate_registration_list',compact('passportInfos'));
    }


    public function bmetRegistrationDetails($id){

        $jobs = JobManagement::where('recruiting_agencies_id', auth()->id())->where('status',3)->where('no_of_post_already_finished','>',0)->with('jobCategory','country')->latest()->get();
        $passportDetailsInfos = CandidatePassportInfo::where('id',$id)->with('personalInfo','personalInfo.religion','contactInfo',
            'contactInfo.permanentDistrict', 'contactInfo.permanentUpazila', 'contactInfo.mailingDistrict','contactInfo.mailingUpazila','contactInfo.relation',
            'nomineeInfo','nomineeInfo.nomineeDistrict','nomineeInfo.nomineeUpazila','nomineeInfo.relation',
            'qualificationInfo','qualificationInfo.language','verificationInfo','jobAttached')->first();
        return view('recruitingAgency.pages.bmetRegistration.bmet_candidate_registration_details',compact('passportDetailsInfos','jobs'));
    }

    public function getUpazilas($districtId)
    {
        $upazilas = Upazilla::where('district_id', $districtId)->get();
        return response()->json($upazilas);
    }



    public function registrationForm()
    {

    }
    public function bmetRegistration(Request $request, $type = 'passport-info', $id = null)
    {
        //dd($request->all());
        // Fetch all dropdown districts, currency, and religion
        $districts = District::where('status', 1)->get();
        $currency = Currency::where('status', 1)->get();
        $religion = Religion::where('status', 1)->get();
        $relation = Relation::where('status', 1)->get();
        $langauge = Language::where('status', 1)->get();
        $jobCategory = JobCategory::where('status', 1)->get();
        $educationLevel = EducationLevel::where('status', 1)->get();
        $board = Board::where('status', 1)->get();
        // Fetch existing passport info if updating
        $passportInfo = null;
        $personalInfo = null;
        $contactInfo = null;
        $nomineeInfo = null;
        $qualificationInfo = null;
        $verificationInfo = null;
        if ($id) {
            $passportInfo = CandidatePassportInfo::with('district:id,district_name_en','currency:id,country_name')->find($id);
            $personalInfo = BmetCandidatePersonalInfo::where('passport_info_id', $id)->with('religion:id,religion_name')->first();
            $contactInfo = BmetCandidateContactInfo::where('passport_info_id', $id)->with('permanentDistrict:id,district_name_en','permanentUpazila:id,upazila_name_en','mailingDistrict:id,district_name_en','mailingUpazila:id,upazila_name_en','relation:id,relation_name')->first();
            $nomineeInfo = BmetCandidateNomineeInfo::where('passport_info_id', $id)->with('nomineeDistrict:id,district_name_en','nomineeUpazila:id,upazila_name_en','relation:id,relation_name')->first();
            $qualificationInfo = BmetCandidateQualificationInfo::where('passport_info_id', $id)
                ->with('educationLevel:id,education_level_name', 'board:id,board_name', 'language:id,language_name')
                ->first();
            if ($qualificationInfo) {
                $preferredJobCategoryIds = json_decode($qualificationInfo->preferred_job_category_id);
                $desiredCurrencyIds = json_decode($qualificationInfo->desired_currency_id);
                if (is_array($preferredJobCategoryIds) && is_array($desiredCurrencyIds)) {
                    $preferredJobCategories = JobCategory::whereIn('id', $preferredJobCategoryIds)->pluck('job_category_name')->toArray();
                    $desiredCurrencies = Currency::whereIn('id', $desiredCurrencyIds)->pluck('country_name')->toArray();
                    $qualificationInfo->preferredJobCategories = $preferredJobCategories;
                    $qualificationInfo->desiredCurrencies = $desiredCurrencies;
                } else {
                    // Handle the case where the JSON decode did not produce arrays
                }
            }
            $verificationInfo = BmetCandidateVerificationInfo::where('passport_info_id', $id)->first();
        }
        if ($request->isMethod('post')) {
            if ($type === 'passport-info') {
                // Create or update passport info
                $candidatePassportImage = 'candidatePassport';
                if ($request->hasFile('passport_image')) {
                    $passportImage = $request->file('passport_image')->store($candidatePassportImage, 'public');
                }else{
                    // Check if $passportInfo is not null before accessing its properties
                    if ($passportInfo) {
                        $passportImage = $passportInfo->passport_image;
                    } else {
                        $passportImage = null;
                    }
                }

                if ($passportInfo) {

                    // Validation
                    $validator = Validator::make($request->all(), [
                        'passport_no' => 'required|string|min:9|max:9',
                        'phone' => 'required|string|min:11|max:11',
                        'passport_issue_date' => 'required|date',
                        'passport_expiry_date' => 'required|date|date_before:passport_issue_date',
                        'dob' => 'required|date|is_adult',
                        'full_name' => 'required|string',
                        'gender' => 'required',
                        'district_id' => 'required|exists:districts,id',
                        'passport_image' => 'passport_image|mimes:jpeg,png,jpg,gif|max:2048',
                    ]);

                     /*if ($validator->fails()) {
                          return redirect()->back()->withErrors($validator)->withInput();
                      }*/

                    // Update existing passport info
                    $passportInfo->update([
                        'passport_no' => $request->input('passport_no'),
                        'phone' => $request->input('phone'),
                        'passport_issue_date' => $request->input('passport_issue_date'),
                        'passport_expiry_date' => $request->input('passport_expiry_date'),
                        'dob' => $request->input('dob'),
                        'full_name' => $request->input('full_name'),
                        'gender' => $request->input('gender'),
                        'district_id' => $request->input('district_id'),
                        'passport_image' => $passportImage,
                    ]);
                } else {

                    // Validation
                    $request->validate([
                        'passport_no' => 'required|string|min:9|max:9',
                        'phone' => 'required|string|min:11|max:11',
                        'passport_issue_date' => 'required|date',
                        'passport_expiry_date' => 'required|date|date_before:passport_issue_date',
                        'dob' => 'required|date|is_adult',
                        'full_name' => 'required|string',
                        'gender' => 'required',
                        'district_id' => 'required|exists:districts,id',

                        //'passport_image' => 'passport_image|mimes:jpeg,png,jpg,gif|max:2048',
                    ]);


                    // Create new passport info
                    $passportInfo = new CandidatePassportInfo([
                        'recruiting_agencies_id' => Auth::id(),
                        'passport_no' => $request->input('passport_no'),
                        'phone' => $request->input('phone'),
                        'passport_issue_date' => $request->input('passport_issue_date'),
                        'passport_expiry_date' => $request->input('passport_expiry_date'),
                        'dob' => $request->input('dob'),
                        'full_name' => $request->input('full_name'),
                        'gender' => $request->input('gender'),
                        'district_id' => $request->input('district_id'),
                        'passport_image' => $passportImage ?? null,
                        'status' => 1,
                    ]);
                    $passportInfo->save();
                    // Pass passport id in personal info table colum pasport_info_id
                    $personalInfo = new BmetCandidatePersonalInfo();
                    $personalInfo->passport_info_id = $passportInfo->id;
                    $personalInfo->save();
                }
            } elseif ($type === 'personal-info') {
                // Create or update personal info
                if ($passportInfo) {

                    // Validation
                    $validator = Validator::make($request->all(), [
                        'religion_id' => 'required|exists:religions,id',
                        'fathers_name' => 'required|string',
                        'mothers_name' => 'required|string',
                        'marital_status' => 'required',
                        'height_feet' => 'required|integer',
                        'weight' => 'required|integer',
                    ]);

                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }

                    $personalInfo = BmetCandidatePersonalInfo::updateOrCreate(
                        ['passport_info_id' => $passportInfo->id],
                        [
                            'religion_id' => $request->input('religion_id'),
                            'fathers_name' => $request->input('fathers_name'),
                            'mothers_name' => $request->input('mothers_name'),
                            'marital_status' => $request->input('marital_status'),
                            'spouse_name' => $request->input('spouse_name'),
                            'height_feet' => $request->input('height_feet'),
                            'height_inch' => $request->input('height_inch'),
                            'weight' => $request->input('weight'),
                            'status' => 1,
                        ],
                    );
                    BmetCandidateContactInfo::updateOrCreate(
                    [
                        'passport_info_id' =>  $passportInfo->id,
                    ]);
                } else {
                }
            } elseif ($type === 'contact-info'){
                if($passportInfo){

                    // Validation
                    $validator = Validator::make($request->all(), [
                        'permanent_district_id' => 'required|exists:districts,id',
                        'permanent_upazilla_id' => 'required|exists:upazillas,id',
                        'mailing_district_id' => 'nullable|exists:districts,id',
                        'mailing_upazilla_id' => 'nullable|exists:upazillas,id',
                        'relation_id' => 'required|exists:relations,id',
                        'permanent_union' => 'required|string',
                        'permanent_village' => 'required|string',
                        'permanent_house' => 'required|string',
                        'mailing_union' => 'nullable|string',
                        'mailing_village' => 'nullable|string',
                        'mailing_house' => 'nullable|string',
                        'emergency_contact_person_name' => 'required|string',
                        'emergency_contact_person_phone' => 'required|string|min:11|max:11',
                    ]);

                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }

                    $contactInfo = BmetCandidateContactInfo::updateOrCreate(
                        ['passport_info_id' => $passportInfo->id],
                        [
                            'permanent_district_id' => $request->input('permanent_district_id'),
                            'permanent_upazilla_id' => $request->input('permanent_upazilla_id'),
                            'mailing_district_id' => $request->input('mailing_district_id'),
                            'mailing_upazilla_id' => $request->input('mailing_upazilla_id'),
                            'relation_id' => $request->input('relation_id'),
                            'permanent_union' => $request->input('permanent_union'),
                            'permanent_village' => $request->input('permanent_village'),
                            'permanent_house' => $request->input('permanent_house'),
                            'mailing_union' => $request->input('mailing_union'),
                            'mailing_village' => $request->input('mailing_village'),
                            'mailing_house' => $request->input('mailing_house'),
                            'emergency_contact_person_name' => $request->input('emergency_contact_person_name'),
                            'emergency_contact_person_phone' => $request->input('emergency_contact_person_phone'),
                            'status' => 1
                        ],
                    );
                        BmetCandidateNomineeInfo::updateOrCreate(
                        [
                            'passport_info_id' =>  $passportInfo->id,
                        ]);
                }else{

                }

            }elseif ($type === 'nominee-info'){
                if($passportInfo){

                    // Validation
                    $validator = Validator::make($request->all(), [
                        'nominee_relation_id' => 'required|exists:relations,id',
                        'nominee_name' => 'required|string',
                        'nominee_nid' => 'required|string|min:10|max:17',
                        'nominee_phone' => 'required|string|min:11|max:11',
                        'nominee_fathers_name' => 'required|string',
                        'nominee_mothers_name' => 'required|string',
                    ]);

                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }


                    $nomineeInfo = BmetCandidateNomineeInfo::updateOrCreate(
                        ['passport_info_id' => $passportInfo->id],
                        [
                            'nominee_relation_id' => $request->input('nominee_relation_id'),
                            'nominee_district_id' => $request->input('nominee_district_id'),
                            'nominee_upazilla_id' => $request->input('nominee_upazilla_id'),
                            'nominee_name' => $request->input('nominee_name'),
                            'nominee_nid' => $request->input('nominee_nid'),
                            'nominee_phone' => $request->input('nominee_phone'),
                            'nominee_fathers_name' => $request->input('nominee_fathers_name'),
                            'nominee_mothers_name' => $request->input('nominee_mothers_name'),
                            'nominee_union' => $request->input('nominee_union'),
                            'nominee_village' => $request->input('nominee_village'),
                            'nominee_house' => $request->input('nominee_house'),
                            'status' => 1
                        ],
                    );
                    BmetCandidateQualificationInfo::updateOrCreate(
                        [
                            'passport_info_id' =>  $passportInfo->id,
                        ]);
                }else{

                }
            }elseif ($type === 'qualification'){
                if($passportInfo){

                    // Validation
                    $validator = Validator::make($request->all(), [
                        'education_level_id' => 'required|exists:education_levels,id',
                        'passing_year' => 'required',
                        'institute' => 'required|string',
                        'grade' => 'required|string',
                    ]);

                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }

                    $qualificationInfo = BmetCandidateQualificationInfo::updateOrCreate(
                        ['passport_info_id' => $passportInfo->id],
                        [
                            'education_level_id' => $request->input('education_level_id'),
                            'board_id' => $request->input('board_id'),
                            'language_id' => $request->input('language_id'),
                            'passing_year' => $request->input('passing_year'),
                            'subject' => $request->input('subject'),
                            'institute' => $request->input('institute'),
                            'grade' => $request->input('grade'),
                            'language_oral_skill' => $request->input('language_oral_skill'),
                            'language_writing_skill' => $request->input('language_writing_skill'),
                            'desired_currency_id' => json_encode($request->input('desired_currency_id')),
                            'preferred_job_category_id' => json_encode($request->input('preferred_job_category_id')),
                            'status' => 1,
                        ],
                    );
                    BmetCandidateVerificationInfo::updateOrCreate(
                        [
                            'passport_info_id' =>  $passportInfo->id,
                        ]);
                }else{

                }
            }
            // Redirect to the next step
            $nextStep = $this->getNextStep($type);
            return redirect()->route('recruiting-agency.bmet.registration', ['type' => $nextStep, 'id' => $passportInfo->id]);
        }
        // Pass data to the view


        return view('recruitingAgency.pages.bmetRegistration.bmet_registration', compact('id','type','districts', 'districts', 'currency','jobCategory',
            'religion','relation','educationLevel','board','langauge', 'passportInfo',
            'personalInfo', 'contactInfo','nomineeInfo','qualificationInfo','verificationInfo'));
    }


    private function getNextStep($currentStep)
    {
        //Define the order of steps and their corresponding next steps
        $stepsOrder = [
            'passport-info' => 'personal-info',
            'personal-info' => 'contact-info',
            'contact-info' => 'nominee-info',
            'nominee-info' => 'qualification',
            'qualification' => 'verification',
            'verification' => null,
        ];
        return $stepsOrder[$currentStep] ?? 'passport-info';
    }


    public function bmetCandidateRegistrationPayment(Request $request)
    {
        $passportId = $request->query('id');
        return view('recruitingAgency.pages.bmetRegistration.bmet_candidate_registration_payment', compact('passportId'));
    }


    public function bmetCandidateRegistrationPaymentStore(Request $request)
    {
        try {
            // Create or update the payment record in the BmetCandidatePayment table
            $payment = new BmetCandidatePayment();
            $payment->passport_info_id = $request->input('passport_info_id');
            $payment->payment_method = $request->input('payment_method');
            $payment->payable_amount = $request->input('payable_amount');
            $payment->status = $request->input('status');
            $payment->save();

            // Update the payment_status in the bmet_candidate_verification_infos table
            $passportInfoId = $request->input('passport_info_id');
            $paymentStatus = $request->input('status');

            // Assuming you have a model for the bmet_candidate_verification_infos table, replace 'YourModel' with your actual model name.
            $verificationInfo = BmetCandidateVerificationInfo::where('passport_info_id', $passportInfoId)->first();

            if ($verificationInfo) {
                $verificationInfo->payment_status = $paymentStatus;
                $verificationInfo->save();
            }

            Toastr::success('Payment successfully!', 'Success');
            return redirect()->route('recruiting-agency.bmet.candidate.registration.list');
        } catch (\Throwable $th) {
            Toastr::error('Something went wrong', 'Error');
            return redirect()->back();
        }
    }




}
