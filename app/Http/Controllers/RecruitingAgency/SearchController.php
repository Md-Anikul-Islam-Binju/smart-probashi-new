<?php

namespace App\Http\Controllers\RecruitingAgency;

use App\Http\Controllers\Controller;
use App\Models\admin\Currency;
use App\Models\admin\District;
use App\Models\admin\EducationLevel;
use App\Models\admin\JobCategory;
use App\Models\admin\TrainingCenterInfo;
use App\Models\admin\Upazilla;
use App\Models\RecruitingAgency\CandidatePassportInfo;
use App\Models\RecruitingAgency\JobManagement;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function skillSearch(Request $request)
    {

        $education = EducationLevel::latest()->get();
        $country= Currency::latest()->get();
        $jobCategories = JobCategory::latest()->get();
        return view('recruitingAgency.pages.talentPoolSearch.talent_pool_search', compact('education', 'country', 'jobCategories'));

    }

    public function skillSearchResult(Request $request)
    {
        $jobs = JobManagement::where('recruiting_agencies_id', auth()->id())->where('status',3)->where('no_of_post_already_finished','>',0)->with('jobCategory','country')->latest()->get();
        $query = CandidatePassportInfo::where('recruiting_agencies_id', auth()->id())
            ->with('qualificationInfo', 'jobAttached','verificationInfo')
            ->latest();


        if ($request->filled('job_category_name')) {
            $query->whereHas('jobAttached', function ($subQuery) use ($request) {
                $subQuery->where('job_category_name', $request->input('job_category_name'));
            });
        }

        if ($request->filled('desired_currency_id')) {
            $query->whereHas('qualificationInfo', function ($subQuery) use ($request) {
                $subQuery->whereJsonContains('desired_currency_id', $request->input('desired_currency_id'));
            });
        }
        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }
        if ($request->filled('education')) {
            $educationLevel = $request->input('education');
            $query->whereHas('qualificationInfo', function ($subQuery) use ($educationLevel) {
                $subQuery->where('education', 'like', '%"level":"' . $educationLevel . '"%');
            });
        }
        if ($request->filled('registration_status')) {
            $query->whereHas('verificationInfo', function ($subQuery) use ($request) {
                $subQuery->where('registration_status', $request->input('registration_status'));
            });
        }

        if ($request->filled('min_age') || $request->filled('max_age')) {
            $query->whereHas('jobAttached', function ($subQuery) use ($request) {
                $subQuery->whereHas('job', function ($jobSubQuery) use ($request) {
                    if ($request->filled('min_age')) {
                        $jobSubQuery->where('min_age', '>=', $request->input('min_age'));
                    }
                    if ($request->filled('max_age')) {
                        $jobSubQuery->where('max_age', '<=', $request->input('max_age'));
                    }
                });
            });
        }



        if ($request->filled('status')) {
            $query->whereHas('jobAttached', function ($subQuery) use ($request) {
                $subQuery->where('status', $request->input('status'));
            });
        }
        $allRegisterUser = $query->paginate(10);
        return view('recruitingAgency.pages.talentPoolSearch.talent_pool_search_result', compact('allRegisterUser','jobs'));
    }


    public function getUpazilas($districtId)
    {
        $upazilas = Upazilla::where('district_id', $districtId)->get();
        return response()->json($upazilas);
    }
    public function malaysiaCandidateSearch(Request $request)
    {
        $districts = District::where('status', 1)->get();
        $education = EducationLevel::latest()->get();
        $country= Currency::where('currency_code',4217)->first();
        $jobCategories = JobCategory::latest()->get();
        return view('recruitingAgency.pages.malaysiaCandidateSearch.malaysia_candidate_search', compact('education', 'country', 'jobCategories','districts'));

    }

    public function malaysiaCandidateSearchResult(Request $request)
    {
        $jobs = JobManagement::where('recruiting_agencies_id', auth()->id())->where('status',3)->where('no_of_post_already_finished','>',0)->with('jobCategory','country')->latest()->get();
        $query = CandidatePassportInfo::where('recruiting_agencies_id', auth()->id())
            ->with('qualificationInfo', 'jobAttached','verificationInfo','contactInfo')
            ->latest();


        if ($request->filled('job_category_name')) {
            $query->whereHas('jobAttached', function ($subQuery) use ($request) {
                $subQuery->where('job_category_name', $request->input('job_category_name'));
            });
        }

        if ($request->filled('desired_currency_id')) {
            $query->whereHas('qualificationInfo', function ($subQuery) use ($request) {
                $subQuery->whereJsonContains('desired_currency_id', $request->input('desired_currency_id'));
            });
        }
        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }
        if ($request->filled('education')) {
            $educationLevel = $request->input('education');
            $query->whereHas('qualificationInfo', function ($subQuery) use ($educationLevel) {
                $subQuery->where('education', 'like', '%"level":"' . $educationLevel . '"%');
            });
        }
        if ($request->filled('registration_status')) {
            $query->whereHas('verificationInfo', function ($subQuery) use ($request) {
                $subQuery->where('registration_status', $request->input('registration_status'));
            });
        }

        if ($request->filled('min_age') || $request->filled('max_age')) {
            $query->whereHas('jobAttached', function ($subQuery) use ($request) {
                $subQuery->whereHas('job', function ($jobSubQuery) use ($request) {
                    if ($request->filled('min_age')) {
                        $jobSubQuery->where('min_age', '>=', $request->input('min_age'));
                    }
                    if ($request->filled('max_age')) {
                        $jobSubQuery->where('max_age', '<=', $request->input('max_age'));
                    }
                });
            });
        }



        if ($request->filled('status')) {
            $query->whereHas('jobAttached', function ($subQuery) use ($request) {
                $subQuery->where('status', $request->input('status'));
            });
        }

        if ($request->filled('permanent_district_id')) {
            $query->whereHas('contactInfo', function ($subQuery) use ($request) {
                $subQuery->where('permanent_district_id', $request->input('district_id'));
            });
        }

        if ($request->filled('permanent_upazilla_id')) {
            $query->whereHas('contactInfo', function ($subQuery) use ($request) {
                $subQuery->where('permanent_upazilla_id', $request->input('upazilla_id'));
            });
        }


        $allRegisterUser = $query->paginate(10);
        return view('recruitingAgency.pages.malaysiaCandidateSearch.malaysia_candidate_search_result', compact('allRegisterUser','jobs'));
    }
}
