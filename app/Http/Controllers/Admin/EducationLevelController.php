<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\EducationLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Toastr;
class EducationLevelController extends Controller
{
    public function index()
    {
        $education_levels = EducationLevel::latest()->get();
        return view('admin.pages.education_level.index',compact('education_levels'));
    }

    public function store(Request $request)
    {
        //use try catch to handle error
        try {
            $request->validate([
                'education_level_name' => 'required|max:255',
            ]);
            $education_level = new EducationLevel();
            $education_level->education_level_name = $request->education_level_name;
            $education_level->save();
            Toastr::success('Education Level added successfully!', 'Success');
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
                'education_level_name' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $education_level = EducationLevel::findOrFail($id);
            $education_level->education_level_name = $request->input('education_level_name');
            $education_level->status = $request->input('status');
            $education_level->save();
            Toastr::success('Education Level updated successfully!', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {

        try {
            $education_level = EducationLevel::findOrFail($id);
            $education_level->delete();

            Toastr::error('EducationLevel deleted successfully!', 'Error');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->route('admin.job.category')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
