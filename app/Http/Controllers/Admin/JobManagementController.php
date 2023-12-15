<?php

namespace App\Http\Controllers\Admin;

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
        $jobCategories = JobCategory::where('status', 1)->latest()->get();
        $country = Currency::where('status', 1)->latest()->get();
        $statusValues = [1, 2, 3];
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
        return view('admin.pages.recruiting_agency.job.job_list', compact('jobs', 'jobCategories', 'country'));
    }

    public function show($id)
    {
        $job = JobManagement::where('id',$id)->with('jobCategory','country')->first();
        return view('admin.pages.recruiting_agency.job.job_details', compact('job'));
    }

    public function jobTransfer($id)
    {
        $job = JobManagement::find($id);
        if ($job) {
            $job->update(['status' => 2]);
            Toastr::success('Job Transfer to Foreign Ministry successfully!', 'Success');
        } else {
            Toastr::error('Job not Transfer!', 'Error');
        }

        return redirect()->back();
    }
}
