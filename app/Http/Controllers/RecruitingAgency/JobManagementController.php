<?php

namespace App\Http\Controllers\RecruitingAgency;

use App\Http\Controllers\Controller;
use App\Models\admin\Currency;
use App\Models\admin\JobCategory;
use App\Models\RecruitingAgency\JobAttached;
use App\Models\RecruitingAgency\JobManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Toastr;
class JobManagementController extends Controller
{
    public function index(Request $request)
    {
        $jobCategories = JobCategory::where('status', 1)->latest()->get();
        $country = Currency::where('status', 1)->latest()->get();
        $jobTypeFilter = $request->input('job_type');
        $jobCategoryFilter = $request->input('job_category');
        $jobCountryFilter = $request->input('country');
        $jobApproveFilter = $request->input('approve_status');
        $jobs = JobManagement::where('recruiting_agencies_id', auth()->id());
        if ($jobTypeFilter) {
            $jobs->where('job_type', $jobTypeFilter);
        }
        if ($jobCategoryFilter) {
            $jobs->where('category_id', $jobCategoryFilter);
        }
        if ($jobCountryFilter) {
            $jobs->where('country_id', $jobCountryFilter);
        }
        if ($jobApproveFilter) {
            $jobs->where('status', $jobApproveFilter);
        }
        $jobs = $jobs->where('status', '!=', 5)->with('jobCategory','country')
            ->latest()
            ->paginate(10);
        //$jobs = JobManagement::where('recruiting_agencies_id', auth()->id())->with('jobCategory','country')->latest()->get();
        return view('recruitingAgency.pages.jobs.job_list', compact('jobs', 'jobCategories', 'country'));
    }

    public function create()
    {
        $categories = JobCategory::where('status',1)->get();
        $countries = Currency::where('status',1)->get();
        return view('recruitingAgency.pages.jobs.job_add', compact('categories','countries'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'category_id' => 'required',
                'country_id' => 'required',
                'currency_id' => 'required',
                'no_of_post' => 'required',
                'bmet_reference_no' => 'required',
                'foreign_reference_no' => 'required',
                'ministry_reference_no' => 'required',
                'min_age' => 'required',
                'max_age' => 'required',
                'salary_amount' => 'required',
                'salary_per' => 'required',
            ]);
            $employmentPermitFile = 'job/employmentPermit/';
            $demandLatterFile = 'job/demandLatter/';
            $workAgreementFile = 'job/workAgreement/';
            $otherFile = 'job/other/';
            if ($request->hasFile('employment_permit_file')) {
                $employmentPermit = $request->file('employment_permit_file')->store($employmentPermitFile, 'public');
            }
            if ($request->hasFile('demand_latter_file')) {
                $demandLatter = $request->file('demand_latter_file')->store($demandLatterFile, 'public');
            }
            if ($request->hasFile('work_agreement_file')) {
                $workAgreement = $request->file('work_agreement_file')->store($workAgreementFile, 'public');
            }
            if ($request->hasFile('other_file')) {
                $other = $request->file('other_file')->store($otherFile, 'public');
            }
            $job = new JobManagement();
            $job->recruiting_agencies_id = Auth::id();
            $job->category_id = $request->category_id;
            $job->country_id = $request->country_id;
            $job->currency_id = $request->currency_id;
            $job->sector = $request->sector;
            $job->no_of_post = $request->no_of_post;
            $job->no_of_post_already_finished = $request->no_of_post;
            $job->city_name = $request->city_name;
            $job->employee_name = $request->employee_name;
            $job->bmet_reference_no = $request->bmet_reference_no;
            $job->foreign_reference_no = $request->foreign_reference_no;
            $job->foreign_reference_date = $request->foreign_reference_date;
            $job->ministry_reference_no = $request->ministry_reference_no;
            $job->ministry_reference_date = $request->ministry_reference_date;
            $job->skill_type = $request->skill_type;
            $job->job_type = 'attested';
            $job->gender = $request->gender;
            $job->min_age = $request->min_age;
            $job->max_age = $request->max_age;
            $job->description_en = $request->description_en;
            $job->description_bn = $request->description_bn;
            $job->salary_amount = $request->salary_amount;
            $job->salary_per = $request->salary_per;
            $job->is_accommodation = $request->is_accommodation;
            $job->is_food = $request->is_food;
            $job->is_transport = $request->is_transport;
            $job->is_medical = $request->is_medical;
            $job->is_visa = $request->is_visa;
            $job->is_insurance = $request->is_insurance;
            $job->contract_tenure = $request->contract_tenure;
            $job->probation_period = $request->probation_period;
            $job->requirements_details = $request->requirements_details;
            $job->benefits_details = $request->benefits_details;
            $job->condition_details = $request->condition_details;
            $job->additional_details = $request->additional_details;
            $job->application_deadline = $request->application_deadline;
            $job->employer_deadline = $request->employer_deadline;
            $job->employment_permit_file = $employmentPermit ?? null;
            $job->demand_latter_file = $demandLatter ?? null;
            $job->work_agreement_file = $workAgreement ?? null;
            $job->other_file = $other ?? null;
            $job->save();

            Toastr::success('Job added successfully!', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function show($id)
    {
        $job = JobManagement::with('jobCategory','country')->find($id);
        return view('recruitingAgency.pages.jobs.job_details', compact('job'));
    }

    public function edit($id)
    {
        $job = JobManagement::with('jobCategory','country')->find($id);
        $categories = JobCategory::where('status',1)->get();
        $countries = Currency::where('status',1)->get();

        if($job->job_type=='attested'){
            return view('recruitingAgency.pages.jobs.job_edit', compact('job','categories','countries'));
        }elseif ($job->job_type=='skill_search') {
            return view('recruitingAgency.pages.jobs.skill_search_job_edit', compact('job','categories','countries'));
        }

    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'category_id' => 'required',
                'country_id' => 'required',
                'currency_id' => 'required',
                'no_of_post' => 'required',
                'bmet_reference_no' => 'required',
                'foreign_reference_no' => 'required',
                'ministry_reference_no' => 'required',
                'min_age' => 'required',
                'max_age' => 'required',
                'salary_amount' => 'required',
                'salary_per' => 'required',
            ]);
            $job = JobManagement::findOrFail($id);
            $job->category_id = $request->category_id;
            $job->country_id = $request->country_id;
            $job->currency_id = $request->currency_id;
            $job->sector = $request->sector;
            $job->no_of_post = $request->no_of_post;
            $job->city_name = $request->city_name;
            $job->employee_name = $request->employee_name;
            $job->bmet_reference_no = $request->bmet_reference_no;
            $job->foreign_reference_no = $request->foreign_reference_no;
            $job->foreign_reference_date = $request->foreign_reference_date;
            $job->ministry_reference_no = $request->ministry_reference_no;
            $job->ministry_reference_date = $request->ministry_reference_date;
            $job->skill_type = $request->skill_type;
            $job->gender = $request->gender;
            $job->min_age = $request->min_age;
            $job->max_age = $request->max_age;
            $job->description_en = $request->description_en;
            $job->description_bn = $request->description_bn;
            $job->salary_amount = $request->salary_amount;
            $job->salary_per = $request->salary_per;
            $job->is_accommodation = $request->is_accommodation;
            $job->is_food = $request->is_food;
            $job->is_transport = $request->is_transport;
            $job->is_medical = $request->is_medical;
            $job->is_visa = $request->is_visa;
            $job->is_insurance = $request->is_insurance;
            $job->contract_tenure = $request->contract_tenure;
            $job->probation_period = $request->probation_period;
            $job->requirements_details = $request->requirements_details;
            $job->benefits_details = $request->benefits_details;
            $job->condition_details = $request->condition_details;
            $job->additional_details = $request->additional_details;
            $job->application_deadline = $request->application_deadline;
            $job->employer_deadline = $request->employer_deadline;
            // Handle file uploads if they are present in the request
            if ($request->hasFile('employment_permit_file')) {
                $employmentPermitFile = $request->file('employment_permit_file')->store('job/employmentPermit/', 'public');
                $job->employment_permit_file = $employmentPermitFile;
            }

            if ($request->hasFile('demand_latter_file')) {
                $demandLatterFile = $request->file('demand_latter_file')->store('job/demandLatter/', 'public');
                $job->demand_latter_file = $demandLatterFile;
            }

            if ($request->hasFile('work_agreement_file')) {
                $workAgreementFile = $request->file('work_agreement_file')->store('job/workAgreement/', 'public');
                $job->work_agreement_file = $workAgreementFile;
            }
            if ($request->hasFile('other_file')) {
                $otherFile = $request->file('other_file')->store('job/other/', 'public');
                $job->other_file = $otherFile;
            }
            $job->save();
            Toastr::success('Job updated successfully!', 'Success');
            return redirect()->route('recruiting-agency.job.list');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


    public function publishedJob($id)
    {
        JobManagement::where('id',$id)->update(['status'=> 1]);
        return redirect()->back()->with('success','Job Published Successfully');
    }

    public function unpublishedJob($id)
    {
        JobManagement::where('id',$id)->update(['status'=> 0]);
        return redirect()->back()->with('danger','Job Unpublished Successfully');
    }

    public function attachedJob(Request $request)
    {
        // Use try-catch to handle errors gracefully
        try {
            // Validate the request data
            $request->validate([
                'passport_info_id' => 'required',
                'job_id' => 'required',
                'status' => 'required',
            ]);
            // Create a new JobAttached instance and save it
            $attached_job = new JobAttached();
            $attached_job->recruiting_agencies_id = Auth::user()->id;
            $attached_job->passport_info_id = $request->passport_info_id;
            $attached_job->job_id = $request->job_id;
            $attached_job->job_category_name = $request->job_category_name;
            $attached_job->status = $request->status;
            $attached_job->save();
            // Update the job_management table if the status is 2
            if ($request->status == 2) {
                $jobId = $request->job_id;
                $jobManagement = JobManagement::where('id', $jobId)->first();

                if ($jobManagement) {
                    $jobManagement->decrement('no_of_post_already_finished', 1);
                    $jobManagement->save();
                }
            }
            // Add a success message using Toastr or Laravel's built-in flash messaging
            Toastr::success('Job attached successfully!', 'Success');
            // Redirect back to the previous page or a specific route
            return redirect()->back();
        } catch (\Throwable $th) {
            // Handle any exceptions that occur during the process
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

	public function jobApplications(Request $request, $id)
    {


        //$jobs = JobManagement::where('id',$id)->with('jobCategory','country','attachedJobs.passportInfo')->withCount('attachedJobs')->first();
        $query = JobManagement::where('recruiting_agencies_id', auth()->id())
            ->where('id',$id)
            ->with([
                    'jobCategory',
                    'country',
                    'attachedJobs'=> function ($subQuery) use ($request)
                    {
                        if ($request->filled('status')) {
                            $subQuery->where('status', $request->input('status'));
                        }
                    },
                    'attachedJobs.passportInfo'
                  ])
            ->withCount('attachedJobs');
        if ($request->filled('job_type')) {
            $query->where('job_type', $request->input('job_type'));
        }
        if ($request->filled('employee_name')) {
            $query->where('employee_name', $request->input('employee_name'));
        }
        if ($request->filled('gender')) {
            $query->whereHas('attachedJobs.passportInfo', function ($subQuery) use ($request) {
                $subQuery->where('gender', $request->input('gender'));
            });
        }
        if ($request->filled('min_age')) {
            $query->where('min_age', '>=', $request->input('min_age'));
        }
        if ($request->filled('max_age')) {
            $query->where('max_age', '<=', $request->input('max_age'));
        }

        if ($request->filled('skill_type')) {
            $query->where('skill_type', $request->input('skill_type'));
        }

        $jobs = $query->first();
        return view('recruitingAgency.pages.jobs.all_applications',compact('jobs'));
    }

//    public function jobApplicationsShortlisted($id)
//    {
//        $jobs = JobManagement::where('id', $id)
//            ->with('jobCategory', 'country')
//            ->withCount('attachedJobs')
//            ->first();
//        $jobs->attachedJobs = $jobs->attachedJobs->filter(function ($attachedJob) {
//            return $attachedJob->status == 1;
//        });
//        return view('recruitingAgency.pages.jobs.shortlisted_applications',compact('jobs'));
//    }

//    public function jobApplicationsSelected($id)
//    {
//        $jobs = JobManagement::where('id', $id)
//            ->with('jobCategory', 'country')
//            ->withCount('attachedJobs')
//            ->first();
//        $jobs->attachedJobs = $jobs->attachedJobs->filter(function ($attachedJob) {
//            return $attachedJob->status == 2;
//        });
//        return view('recruitingAgency.pages.jobs.selected_applications',compact('jobs'));
//    }

    public function jobApplicationsShortlisted(Request $request, $id)
    {

        $query = JobManagement::where('recruiting_agencies_id', auth()->id())
            ->where('id', $id)
            ->with('jobCategory', 'country', 'attachedJobs.passportInfo')
            ->withCount('attachedJobs');
        if ($request->filled('status')) {
            $query->whereHas('attachedJobs', function ($subQuery) use ($request) {
                $subQuery->where('status', $request->input('status'));
            });
        }
        if ($request->filled('job_type')) {
            $query->where('job_type', $request->input('job_type'));
        }
        if ($request->filled('employee_name')) {
            $query->where('employee_name', $request->input('employee_name'));
        }
        if ($request->filled('gender')) {
            $query->whereHas('attachedJobs.passportInfo', function ($subQuery) use ($request) {
                $subQuery->where('gender', $request->input('gender'));
            });
        }
        if ($request->filled('min_age')) {
            $query->where('min_age', '>=', $request->input('min_age'));
        }
        if ($request->filled('max_age')) {
            $query->where('max_age', '<=', $request->input('max_age'));
        }
        if ($request->filled('skill_type')) {
            $query->where('skill_type', $request->input('skill_type'));
        }
        $jobs = $query->first();
        if ($jobs) {
            $jobs->attachedJobs = $jobs->attachedJobs->filter(function ($attachedJob) {
                return $attachedJob->status == 1;
            });
        }
        return view('recruitingAgency.pages.jobs.shortlisted_applications',compact('jobs'));
    }


    public function jobApplicationsSelected(Request $request, $id)
    {

        $query = JobManagement::where('recruiting_agencies_id', auth()->id())
            ->where('id', $id)
            ->with('jobCategory', 'country', 'attachedJobs.passportInfo')
            ->withCount('attachedJobs');

        if ($request->filled('status')) {
            $query->whereHas('attachedJobs', function ($subQuery) use ($request) {
                $subQuery->where('status', $request->input('status'));
            });
        }
        if ($request->filled('job_type')) {
            $query->where('job_type', $request->input('job_type'));
        }
        if ($request->filled('employee_name')) {
            $query->where('employee_name', $request->input('employee_name'));
        }
        if ($request->filled('gender')) {
            $query->whereHas('attachedJobs.passportInfo', function ($subQuery) use ($request) {
                $subQuery->where('gender', $request->input('gender'));
            });
        }
        if ($request->filled('min_age')) {
            $query->where('min_age', '>=', $request->input('min_age'));
        }
        if ($request->filled('max_age')) {
            $query->where('max_age', '<=', $request->input('max_age'));
        }
        if ($request->filled('skill_type')) {
            $query->where('skill_type', $request->input('skill_type'));
        }

        $jobs = $query->first();

        if ($jobs) {
            $jobs->attachedJobs = $jobs->attachedJobs->filter(function ($attachedJob) {
                return $attachedJob->status == 2;
            });
        }

        return view('recruitingAgency.pages.jobs.selected_applications', compact('jobs'));
    }


    public function createSkillJob()
    {
        $categories = JobCategory::where('status',1)->get();
        $countries = Currency::where('status',1)->get();
        return view('recruitingAgency.pages.jobs.skill_search_job_add', compact('categories','countries'));
    }

    public function storeSkillJob(Request $request)
    {
        try {
            $request->validate([
                'category_id' => 'required',
                'country_id' => 'required',
                'no_of_post' => 'required',
            ]);
            $job = new JobManagement();
            $job->recruiting_agencies_id = Auth::id();
            $job->category_id = $request->category_id;
            $job->country_id = $request->country_id;
            $job->no_of_post = $request->no_of_post;
            $job->no_of_post_already_finished = $request->no_of_post;
            $job->city_name = $request->city_name;
            $job->description_en = $request->description_en;
            $job->description_bn = $request->description_bn;
            $job->job_type = 'skill_search';
            $job->save();
            Toastr::success('Job added successfully!', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


    public function updateSkillJob(Request $request, $id)
    {
        try {
            $request->validate([
                'category_id' => 'required',
                'country_id' => 'required',
                'no_of_post' => 'required',
            ]);
            $job = JobManagement::findOrFail($id);
            $job->category_id = $request->category_id;
            $job->country_id = $request->country_id;
            $job->no_of_post = $request->no_of_post;
            $job->city_name = $request->city_name;
            $job->description_en = $request->description_en;
            $job->description_bn = $request->description_bn;

            $job->save();
            Toastr::success('Job updated successfully!', 'Success');
            return redirect()->route('recruiting-agency.job.list');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function allJobApplications()
    {
        $jobs = JobManagement::where('recruiting_agencies_id', auth()->id())->with('jobCategory','country')->withCount('attachedJobs')->latest()->get();
        return view('recruitingAgency.pages.jobs.all_job_applications_list',compact('jobs'));
    }



    public function recruitmentPermissionMalaysia(Request $request)
    {
        $jobCategories = JobCategory::where('status', 1)->latest()->get();
        $country = Currency::where('status', 1)->latest()->get();
        $jobTypeFilter = $request->input('job_type');
        $jobCategoryFilter = $request->input('job_category');
        $jobCountryFilter = $request->input('country');
        $jobApproveFilter = $request->input('approve_status');
        $jobs = JobManagement::where('recruiting_agencies_id', auth()->id());
        if ($jobTypeFilter) {
            $jobs->where('job_type', $jobTypeFilter);
        }
        if ($jobCategoryFilter) {
            $jobs->where('category_id', $jobCategoryFilter);
        }
        if ($jobCountryFilter) {
            $jobs->where('country_id', $jobCountryFilter);
        }
        if ($jobApproveFilter) {
            $jobs->where('status', $jobApproveFilter);
        }
        $jobs = $jobs->whereHas('country', function ($query){
            $query->where('currency_code', 4217);
        })->with('jobCategory','country')
            ->latest()
            ->paginate(10);
        return view('recruitingAgency.pages.jobs.recruitment_permission_malaysia', compact('jobs', 'jobCategories', 'country'));
    }


    public function allApplicationByRegisterCandidate(Request $request)
    {
        $query = JobAttached::where('recruiting_agencies_id', auth()->id())
            ->with('passportInfo', 'job')
            ->latest();
        // Apply filters
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
        if ($request->filled('job_type')) {
            $query->whereHas('job', function ($subQuery) use ($request) {
                $subQuery->where('job_type', $request->input('job_type'));
            });
        }
        if ($request->filled('employee_name')) {
            $query->whereHas('job', function ($subQuery) use ($request) {
                $subQuery->where('employee_name', 'like', '%' . $request->input('employee_name') . '%');
            });
        }
        if ($request->filled('gender')) {
            $query->whereHas('passportInfo', function ($subQuery) use ($request) {
                $subQuery->where('gender', $request->input('gender'));
            });
        }
        if ($request->filled('min_age')) {
            $query->whereHas('job', function ($subQuery) use ($request) {
                $subQuery->where('min_age', '>=', $request->input('min_age'));
            });
        }
        if ($request->filled('max_age')) {
            $query->whereHas('job', function ($subQuery) use ($request) {
                $subQuery->where('max_age', '<=', $request->input('max_age'));
            });
        }
        if ($request->filled('skill_type')) {
            $query->whereHas('job', function ($subQuery) use ($request) {
                $subQuery->where('skill_type', $request->input('skill_type'));
            });
        }
        $allApplication = $query->paginate(10);
        return view('recruitingAgency.pages.jobs.all_application_by_register_candidate', compact('allApplication'));
    }








}
