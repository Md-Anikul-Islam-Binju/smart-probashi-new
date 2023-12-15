<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Religion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Toastr;

class ReligionController extends Controller
{
    public function index()
    {
        $religions = Religion::latest()->get();
        return view('admin.pages.religion.index',compact('religions'));
    }

    public function store(Request $request)
    {
        //use try catch to handle error
        try {
            $request->validate([
                'religion_name' => 'required|max:255',
            ]);
            $religion = new Religion();
            $religion->religion_name = $request->religion_name;
            $religion->save();
            Toastr::success('Religion added successfully!', 'Success');
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
                'religion_name' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $religion = Religion::findOrFail($id);
            $religion->religion_name = $request->input('religion_name');
            $religion->status = $request->input('status');
            $religion->save();
            Toastr::success('Religion updated successfully!', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $religion = Religion::findOrFail($id);
            $religion->delete();

            Toastr::error('Religion deleted successfully!', 'Error');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->route('admin.religion')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


}
