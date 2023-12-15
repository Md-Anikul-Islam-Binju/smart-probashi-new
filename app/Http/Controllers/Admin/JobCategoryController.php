<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Toastr;
class JobCategoryController extends Controller
{
    public function index()
    {
        $job_categories = JobCategory::latest()->get();
        return view('admin.pages.job_category.index',compact('job_categories'));
    }

    public function store(Request $request)
    {
        //use try catch to handle error
        try {
            $request->validate([
                'job_category_name' => 'required|max:255',
            ]);
            $job_categorie = new JobCategory();
            $job_categorie->job_category_name = $request->job_category_name;
            $job_categorie->save();
            Toastr::success('Job Category added successfully!', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    //update
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'job_category_name' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $job_categorie = JobCategory::findOrFail($id);
            $job_categorie->job_category_name = $request->input('job_category_name');
            $job_categorie->status = $request->input('status');
            $job_categorie->save();
            Toastr::success('Job Category updated successfully!', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {

        try {
            $job_categorie = JobCategory::findOrFail($id);
            $job_categorie->delete();

            Toastr::error('Job Category deleted successfully!', 'Error');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->route('admin.job.category')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
