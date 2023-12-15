<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Toastr;
class HospitalController extends Controller
{
    public function index()
    {
        $hospitals = Hospital::latest()->get();
        return view('admin.pages.hospital.index',compact('hospitals'));
    }

    public function store(Request $request)
    {
        //use try catch to handle error
        try {
            $request->validate([
                'name' => 'required',
            ]);
            $hospital = new Hospital();
            $hospital->name = $request->name;
            $hospital->address = $request->address;
            $hospital->save();
            Toastr::success('Hospital added successfully!', 'Success');
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
            $hospital = Hospital::findOrFail($id);
            $hospital->name = $request->input('name');
            $hospital->address = $request->input('address');
            $hospital->status = $request->input('status');
            $hospital->save();
            Toastr::success('Hospital updated successfully!', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $hospital = Hospital::findOrFail($id);
            $hospital->delete();

            Toastr::error('Hospital deleted successfully!', 'Error');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->route('admin.hospital')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
