<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Toastr;
class OrganizationController extends Controller
{
    public function index()
    {
        $organizations = Organization::latest()->get();
        return view('admin.pages.organization.index',compact('organizations'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name_en' => 'required|max:255',
                'name_bn' => 'required|max:255',
                'recruiting_license_no' => 'required|max:255',
                'address_en' => 'required|max:255',
            ]);
            $organization = new Organization();
            $organization->name_en = $request->name_en;
            $organization->name_bn = $request->name_bn;
            $organization->recruiting_license_no = $request->recruiting_license_no;
            $organization->address_en = $request->address_en;
            $organization->address_bn = $request->address_bn;
            $organization->save();
            Toastr::success('Organization updated successfully!', 'Success');
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
                'name_en' => 'required|max:255',
                'name_bn' => 'required|max:255',
                'recruiting_license_no' => 'required|max:255',
                'address_en' => 'required|max:255',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $organization = Organization::findOrFail($id);
            $organization->name_en = $request->input('name_en');
            $organization->name_bn = $request->input('name_bn');
            $organization->recruiting_license_no = $request->input('recruiting_license_no');
            $organization->address_en = $request->input('address_en');
            $organization->address_bn = $request->input('address_bn');
            $organization->status = $request->input('status');
            $organization->save();
            Toastr::success('Organization updated successfully!', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $organization = Organization::findOrFail($id);
            $organization->delete();
            Toastr::error('Organization deleted successfully!', 'Error');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->route('admin.organization')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

}
