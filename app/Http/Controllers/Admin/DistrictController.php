<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\admin\District;
use App\Models\admin\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Toastr;

class DistrictController extends Controller
{
    public function index()
    {
        $division = Division::latest()->get();
        $districts = District::with('division')->latest()->get();
        return view('admin.pages.district.index',compact('districts','division'));
    }

    public function store(Request $request)
    {

        //use try catch to handle error
        try {
            $request->validate([
                'division_id' => 'required',
                'name' => 'required|max:255',
                'name_bn' => 'required|max:255',
            ]);

            $district = new District();

            $district->division_id = $request->division_id;
            $district->name = $request->name;
            $district->name_bn = $request->name_bn;
            $district->save();
            Toastr::success('District added successfully!', 'Success');
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
                'name' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $district = District::findOrFail($id);
            $district->division_id = $request->input('division_id');
            $district->name = $request->input('name');
            $district->name_bn = $request->input('name_bn');
            $district->status = $request->input('status');
            $district->save();
            Toastr::success('District updated successfully!', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $district = District::findOrFail($id);
            $district->delete();
            Toastr::error('District deleted successfully!', 'Error');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->route('admin.district')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

}
