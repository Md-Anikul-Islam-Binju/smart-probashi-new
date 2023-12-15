<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\District;
use App\Models\admin\Upazilla;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Toastr;

class UpazillaController extends Controller
{
    public function index()
    {
        $district = District::latest()->get();
        $upazilas = Upazilla::with('district')->latest()->get();
        return view('admin.pages.upazilla.index',compact('upazilas','district'));
    }

    public function store(Request $request)
    {

        //use try catch to handle error
        try {
            $request->validate([
                'district_id' => 'required',
                'upazila_name_en' => 'required|max:255',
                'upazila_name_bn' => 'required|max:255',
            ]);
            $upazilas = new Upazilla();
            $upazilas->district_id = $request->district_id;
            $upazilas->upazila_name_en = $request->upazila_name_en;
            $upazilas->upazila_name_bn = $request->upazila_name_bn;
            $upazilas->save();
            Toastr::success('Upazila added successfully!', 'Success');
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
                'upazila_name_en' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $upazilas = Upazilla::findOrFail($id);
            $upazilas->district_id = $request->input('district_id');
            $upazilas->upazila_name_en = $request->input('upazila_name_en');
            $upazilas->upazila_name_bn = $request->input('upazila_name_bn');
            $upazilas->status = $request->input('status');
            $upazilas->save();
            Toastr::success('Upazila updated successfully!', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $upazilas = Upazilla::findOrFail($id);
            $upazilas->delete();
            Toastr::error('Upazila deleted successfully!', 'Error');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->route('admin.upazila')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

}
