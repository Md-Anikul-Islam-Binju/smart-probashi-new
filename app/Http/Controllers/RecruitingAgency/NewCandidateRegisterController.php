<?php

namespace App\Http\Controllers\RecruitingAgency;

use App\Http\Controllers\Controller;
use App\Models\admin\Board;
use App\Models\admin\District;
use App\Models\admin\EducationLevel;
use App\Models\admin\Language;
use App\Models\admin\Religion;
use App\Models\admin\Upazilla;
use App\Models\RecruitingAgency\BmetCandidateContactInfo;
use App\Models\RecruitingAgency\BmetCandidateNomineeInfo;
use App\Models\RecruitingAgency\BmetCandidatePersonalInfo;
use App\Models\RecruitingAgency\BmetCandidateQualificationInfo;
use App\Models\RecruitingAgency\CandidatePassportInfo;
use App\Models\RecruitingAgency\JobAttached;
use App\Models\RecruitingAgency\JobManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NewCandidateRegisterController extends Controller
{

    public function getUpazilas($districtId)
    {
        $upazilas = Upazilla::where('district_id', $districtId)->get();
        return response()->json($upazilas);
    }

    public function newCandidateRegister()
    {
       $religion = Religion::latest()->get();
       $district = District::latest()->get();
       $educationLevel = EducationLevel::latest()->get();
       $board = Board::latest()->get();
       $language = Language::latest()->get();
       $job = JobManagement::with('jobCategory','country')->latest()->get();
       return view('recruitingAgency.pages.newCandidateRegistration.new_candidate_registration',
           compact('religion','district','educationLevel','board','job','language'));
    }

    public function newCandidateRegisterInfoStore(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'mothers_name' => 'required',
            'gender' => 'required',
            'passport_no' => 'required',
            'full_name' => 'required',
            'dob' => 'required',
            'religion_id' => 'required',
            'district_id' => 'required',
            'nid_no' => 'required',
            'education' => 'required',
            'job_id' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $candidatePassportImage = 'candidatePassport';
            if ($request->hasFile('passport_image')) {
                $passportImage = $request->file('passport_image')->store($candidatePassportImage, 'public');
            } else {
                $passportImage = null;
            }
            $candidatePassportInfos = CandidatePassportInfo::create([
                'recruiting_agencies_id' => Auth::id(),
                'phone' => $request->input('phone'),
                'passport_no' => $request->input('passport_no'),
                'full_name' => $request->input('full_name'),
                'dob' => $request->input('dob'),
                'gender' => $request->input('gender'),
                'nid_no' => $request->input('nid_no'),
                'district_id' => $request->input('district_id'),
                'passport_image' => $passportImage,
            ]);

            $bmetCandidatePersonalInfos = BmetCandidatePersonalInfo::create([
                'passport_info_id' => $candidatePassportInfos->id,
                'mothers_name' => $request->input('mothers_name'),
                'fathers_name' => $request->input('fathers_name'),
                'religion_id' => $request->input('religion_id'),
            ]);

            $bmetCandidateContactInfos = BmetCandidateContactInfo::create([
                'passport_info_id' => $candidatePassportInfos->id,
                'permanent_district_id' => $request->input('permanent_district_id'),
                'permanent_upazilla_id' => $request->input('permanent_upazilla_id'),
                'permanent_union' => $request->input('permanent_union'),
                'permanent_village' => $request->input('permanent_village'),
                'mailing_district_id' => $request->input('mailing_district_id'),
                'mailing_upazilla_id' => $request->input('mailing_upazilla_id'),
                'mailing_union' => $request->input('mailing_union'),
                'mailing_village' => $request->input('mailing_village'),
                'same_as' => $request->input('same_as'),

            ]);

            $bmetCandidateQualificationInfos = BmetCandidateQualificationInfo::create([
                'passport_info_id' => $candidatePassportInfos->id,
                'education' => json_encode([$request['education']]),
                'language' => json_encode([$request['language']]),

            ]);
            $bmetCandidateNomineeInfos = BmetCandidateNomineeInfo::create([
                'passport_info_id' => $candidatePassportInfos->id,

            ]);
            $jobAttached = JobAttached::create([
                'passport_info_id' => $candidatePassportInfos->id,
                'job_id' => $request->input('job_id'),
                'job_category_name' => $request->input('job_category_name'),
                'status' => 1,
                'recruiting_agencies_id' => Auth::id(),
            ]);
            DB::commit();
            return redirect()->back()->with('success','New Candidate Registration Successfully Done!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error','An error occurred while storing data!');
        }
    }

    public function myDataBank()
    {
        $jobs = JobManagement::where('recruiting_agencies_id', auth()->id())->where('status',3)->where('no_of_post_already_finished','>',0)->with('jobCategory','country')->latest()->get();
        $myDataBank = CandidatePassportInfo::where('recruiting_agencies_id',Auth::id())->get();
        return view('recruitingAgency.pages.dataBank.my_data_bank',compact('myDataBank','jobs'));
    }
}
