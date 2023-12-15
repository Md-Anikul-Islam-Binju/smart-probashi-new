<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Toastr;
class DivisionController extends Controller
{
    public function index()
    {
        $divisions = Division::latest()->get();
        return view('admin.pages.division.index',compact('divisions'));
    }

    public function store(Request $request)
    {
        //use try catch to handle error
        try {
            $request->validate([
                'division_name_en' => 'required|max:255',
                'division_name_bn' => 'required|max:255',
            ]);
            $division = new Division();
            $division->division_name_en = $request->division_name_en;
            $division->division_name_bn = $request->division_name_bn;
            $division->save();
            Toastr::success('Division added successfully!', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    //update
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'division_name_en' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $division = Division::findOrFail($id);
            $division->division_name_bn = $request->input('division_name_bn');
            $division->division_name_bn = $request->input('division_name_bn');
            $division->status = $request->input('status');
            $division->save();
            Toastr::success('Division updated successfully!', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $division = Division::findOrFail($id);
            $division->delete();

            Toastr::error('Division deleted successfully!', 'Error');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->route('admin.division')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }



}
