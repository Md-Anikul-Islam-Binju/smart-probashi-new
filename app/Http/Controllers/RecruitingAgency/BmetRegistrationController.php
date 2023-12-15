<?php

namespace App\Http\Controllers\RecruitingAgency;

use App\Http\Controllers\Controller;
use App\Http\Requests\BMET\ContactRequest;
use App\Http\Requests\BMET\EducationRequest;
use App\Http\Requests\BMET\NomineeRequest;
use App\Http\Requests\BMET\PassportRequest;
use App\Http\Requests\BMET\PersonalRequest;
use App\Models\admin\Board;
use App\Models\admin\Currency;
use App\Models\admin\District;
use App\Models\admin\EducationLevel;
use App\Models\admin\JobCategory;
use App\Models\admin\Language;
use App\Models\admin\Relation;
use App\Models\admin\Religion;
use App\Models\RecruitingAgency\BmetCandidateContactInfo;
use App\Models\RecruitingAgency\BmetCandidateNomineeInfo;
use App\Models\RecruitingAgency\BmetCandidatePersonalInfo;
use App\Models\RecruitingAgency\BmetCandidateQualificationInfo;
use App\Models\RecruitingAgency\BmetCandidateVerificationInfo;
use App\Models\RecruitingAgency\CandidatePassportInfo;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class BmetRegistrationController extends Controller
{
    protected string $dir = 'recruitingAgency.bmetRegistration';

    public function create(Request $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $status = $request->get('status');
        $expatId = $request->get('expat_id');

        // Validate the status.
        if (in_array($status, [1, 2, 3, 4, 5, 6, 7])) {
            $section = $this->determineSection($status, $expatId);
            // Set the session.
            Session(['tab' => $section, 'expat' => $expatId]);
        }

        return view("{$this->dir}.create", [
            'districts' => District::whereStatus(1)->get(),
            'currencies' => Currency::whereStatus(1)->get(),
            'religions' => Religion::whereStatus(1)->get(),
            'languages' => Language::whereStatus(1)->get(),
            'jobCategories' => JobCategory::whereStatus(1)->get(),
            'eduLevels' => EducationLevel::whereStatus(1)->get(),
            'relation' => Relation::whereStatus(1)->get(),
            'boards' => ['Barishal', 'Chattragram', 'Cumilla', 'Dhaka', 'Jashore', 'Mymensingh', 'Rajshahi', 'Sylhet', 'Technical Education Board', 'Madrasah Education Board', 'Dinajpur'],
            'data' => CandidatePassportInfo::with(
                'personalInfo',
                'contactInfo',
                'nomineeInfo',
                'qualificationInfo'
            )->find($expatId)
        ]);
    }


    public function passport(PassportRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('passport_image')) {
            $data['passport_image'] = $request->file('passport_image')->store('candidatePassport', 'public');
        }

        $criteria = [
            'recruiting_agencies_id' => Auth::id(),
            'passport_no' => $data['passport_no']
        ];

        $updateData = [
            'passport_issue_date' => utcDate($data['passport_issue_date']),
            'passport_expiry_date' => utcDate($data['passport_expiry_date']),
            'dob' => utcDate($data['dob']),
            'gender' => $data['gender'],
            'district_id' => $data['district_id'],
            'phone' => $data['mobile'],
            'full_name' => $data['full_name'],
            'status' => 1,
        ];

        if ($request->hasFile('passport_image')) {
            $updateData['passport_image'] = $data['passport_image'];
        }

        $passportInfo = CandidatePassportInfo::updateOrCreate($criteria, $updateData);

        $id = $passportInfo->id;

        return to_route('recruiting-agency.bmet.create', ['expat_id' => $id, 'status' => 2]);
    }


    public function personal(PersonalRequest $request): RedirectResponse
    {
        $data = $request->validated();
        BmetCandidatePersonalInfo::updateOrCreate([
            'passport_info_id' => $data['expat_id']
        ], [
            'religion_id' => $data['religion_id'],
            'fathers_name' => $data['fathers_name'],
            'mothers_name' => $data['mothers_name'],
            'marital_status' => $data['marital_status'],
            'height_feet' => $data['height_feet'],
            'height_inch' => $data['height_inch'],
            'spouse_name' => $data['marital_status'] === 2 ? $data['spouse_name'] : '',
            'weight' => $data['weight'],
        ]);
        return to_route('recruiting-agency.bmet.create', ['expat_id' => $data['expat_id'], 'status' => 3]);
    }


    public function contact(ContactRequest $request): RedirectResponse
    {
        $data = $request->validated();
        BmetCandidateContactInfo::updateOrCreate([
            'passport_info_id' => session('expat')
        ], [
            'permanent_district_id' => $data['permanent_district_id'],
            'permanent_upazilla_id' => $data['permanent_upazilla_id'],
            'mailing_district_id' => $data['mailing_district_id'],
            'mailing_upazilla_id' => $data['mailing_upazilla_id'],
            'relation_id' => $data['relation_id'],
            'permanent_union' => $data['permanent_union'],
            'permanent_village' => $data['permanent_village'],
            'permanent_house' => $data['permanent_house'],
            'mailing_union' => $data['mailing_union'],
            'mailing_village' => $data['mailing_village'],
            'mailing_house' => $data['mailing_house'],
            'emergency_contact_person_name' => $data['emergency_contact_person_name'],
            'emergency_contact_person_phone' => $data['emergency_contact_person_phone'],
            'same_as' => $data['same_as'] ?? 0,
            'status' => 1
        ]);
        return to_route('recruiting-agency.bmet.create', ['expat_id' => session('expat'), 'status' => 4]);
    }

    public function nominee(NomineeRequest $request): RedirectResponse
    {
        $data = $request->validated();
        BmetCandidateNomineeInfo::updateOrCreate([
            'passport_info_id' => session('expat')
        ], [
            'nominee_relation_id' => $data['nominee_relation_id'],
            'nominee_name' => $data['nominee_name'],
            'nominee_nid' => $data['nominee_nid'],
            'nominee_phone' => $data['nominee_phone'],
            'nominee_fathers_name' => $data['nominee_fathers_name'],
            'nominee_mothers_name' => $data['nominee_mothers_name'],

            'nominee_district_id' => $data['nominee_district_id'],
            'nominee_upazilla_id' => $data['nominee_upazilla_id'],
            'nominee_union' => $data['nominee_union'],
            'nominee_village' => $data['nominee_village'],
            'nominee_house' => $data['nominee_house'],
            'same_as' => $data['same_as'] ?? 0,
            'status' => 1
        ]);
        return to_route('recruiting-agency.bmet.create', ['expat_id' => session('expat'), 'status' => 5]);
    }

    public function education(EducationRequest $request): RedirectResponse
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();
            BmetCandidateQualificationInfo::updateOrCreate([
                'passport_info_id' => session('expat')
            ], [
                'education' => json_encode($data['education']),
                'language' => json_encode($data['language']),
                'desired_currency_id' => json_encode($data['desired_currency_id']),
                'preferred_job_category_id' => json_encode($data['preferred_job_category_id']),
                'status' => 1,
            ]);
            BmetCandidateVerificationInfo::updateOrCreate([
                'passport_info_id' => session('expat')
            ]);
            DB::commit();
            return to_route('recruiting-agency.bmet.create', ['expat_id' => session('expat'), 'status' => 6]);
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Sorry, something went wrong.');
        }

    }


    public function getPassportInfo(Request $request): JsonResponse
    {
        return response()->json(
            CandidatePassportInfo::where([
                'recruiting_agencies_id' => Auth::id(),
                'passport_no' => $request->passport_no
            ])->first()
        );
    }


    private function determineSection($status, $expatId): int
    {
        return match ($status) {
            '2' => DB::table('candidate_passport_infos')
                ->where([
                    'recruiting_agencies_id' => Auth::id(),
                    'id' => $expatId
                ])->exists() ? 2 : 1,
            '3' => DB::table('bmet_candidate_personal_infos')
                ->where('passport_info_id', $expatId)
                ->exists() ? 3 : 2,
            '4' => DB::table('bmet_candidate_contact_infos')
                ->where('passport_info_id', $expatId)
                ->exists() ? 4 : 3,
            '5' => DB::table('bmet_candidate_nominee_infos')
                ->where('passport_info_id', $expatId)
                ->exists() ? 5 : 4,
            '6' => DB::table('bmet_candidate_qualification_infos')
                ->where('passport_info_id', $expatId)
                ->exists() ? 6 : 5,
            default => 1,
        };
    }
}
