<?php

namespace App\Http\Controllers\RecruitingAgency;

use App\Http\Controllers\Controller;
use App\Models\RecruitingAgency\RecruitingAgencyInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Toastr;
class RecruitingAgencyInfoController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate incoming data
            $validatedData = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|string',
                'organization_id' => 'required',
                'recruiting_agency_portal_access' => 'required',
                'designation' => 'required',
                'trade_license' => 'required',
                'recruiting_license' => 'required',
                'business_card' => 'required',
                'password'=> 'required',
            ]);
            // Create a new user record
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'role_id' => 3,
                'username' => $validatedData['name'],
                'user_type' => 'recruiting-agency',
                'password' => Hash::make($validatedData['password']),

            ]);


            $tradeLicenseFile = 'recruitingAgency/tradeLicense/';
            $recruitingLicenseFile = 'recruitingAgency/recruitingLicense/';
            $businessCardFile = 'recruitingAgency/businessCard/';

            if ($request->hasFile('trade_license')) {
                $tradeLicense = $request->file('trade_license')->store($tradeLicenseFile, 'public');
            }

            if ($request->hasFile('recruiting_license')) {
                $recruitingLicense = $request->file('recruiting_license')->store($recruitingLicenseFile, 'public');
            }

            if ($request->hasFile('business_card')) {
                $businessCard = $request->file('business_card')->store($businessCardFile, 'public');
            }

            RecruitingAgencyInfo::create([
                'user_id' => $user->id,
                'organization_id' => $validatedData['organization_id'],
                'recruiting_agency_portal_access' => $validatedData['recruiting_agency_portal_access'],
                'designation' => $validatedData['designation'],
                'trade_license' => $tradeLicense ?? null,
                'recruiting_license' => $recruitingLicense ?? null,
                'business_card' => $businessCard ?? null,
            ]);

            Toastr::success('Registration successfully!', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
