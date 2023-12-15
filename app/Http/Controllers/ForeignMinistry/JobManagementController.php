<?php

namespace App\Http\Controllers\ForeignMinistry;

use App\Http\Controllers\Controller;
use App\Models\admin\Currency;
use App\Models\admin\JobCategory;
use App\Models\RecruitingAgency\JobManagement;
use Illuminate\Http\Request;
use Toastr;
class JobManagementController extends Controller
{
    public function index(Request $request)
    {
//        $statusValues = [2, 3];
//        $jobs = JobManagement::whereIn('status', $statusValues)
//            ->with('jobCategory', 'country')
//            ->latest()
//            ->get();

        $jobCategories = JobCategory::where('status', 1)->latest()->get();
        $country = Currency::where('status', 1)->latest()->get();
        $statusValues = [2, 3];
        $jobTypeFilter = $request->input('job_type');
        $jobCategoryFilter = $request->input('job_category');
        $jobCountryFilter = $request->input('country');
        $jobs = JobManagement::whereIn('status', $statusValues);
        if ($jobTypeFilter) {
            $jobs->where('job_type', $jobTypeFilter);
        }
        if ($jobCategoryFilter) {
            $jobs->where('category_id', $jobCategoryFilter);
        }
        if ($jobCountryFilter) {
            $jobs->where('country_id', $jobCountryFilter);
        }
        $jobs = $jobs->with('jobCategory', 'country', 'recruitingAgency')
            ->latest()
            ->paginate(10);
        return view('foreignMinistry.pages.job.job_list', compact('jobs', 'jobCategories', 'country'));
    }

    public function show($id)
    {
        $job = JobManagement::where('id',$id)->with('jobCategory','country')->first();
        return view('foreignMinistry.pages.job.job_details', compact('job'));
    }

    public function jobApproved($id)
    {
        $job = JobManagement::find($id);
        if ($job) {
            $job->update(['status' => 3]);
            Toastr::success('Job Approved Foreign Ministry successfully!', 'Success');
        } else {
            Toastr::error('Job not Approved!', 'Error');
        }
        return redirect()->back();
    }
}
