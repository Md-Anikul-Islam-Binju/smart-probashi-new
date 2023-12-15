<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Toastr;
class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::latest()->get();
        return view('admin.pages.language.index',compact('languages'));
    }

    public function store(Request $request)
    {
        //use try catch to handle error
        try {
            $request->validate([
                'language_name' => 'required|max:255',
            ]);

            $language = new Language();
            $language->language_name = $request->language_name;
            $language->save();
            Toastr::success('Language added successfully!', 'Success');
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
                'language_name' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $language = Language::findOrFail($id);
            $language->language_name = $request->input('language_name');
            $language->status = $request->input('status');
            $language->save();
            Toastr::success('Language updated successfully!', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $language = Language::findOrFail($id);
            $language->delete();

            Toastr::error('Language deleted successfully!', 'Error');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->route('admin.division')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

}
