<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\District;
use App\Models\admin\Division;
use App\Models\admin\TrainingCenterInfo;
use App\Models\admin\Upazilla;
use App\Models\RecruitingAgency\RecruitingAgencyInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Toastr;

class TtcRegistrationController extends Controller
{
    public function index(Request $request)
    {
        $ttcUsers = TrainingCenterInfo::with('trainingCenterByUser')->get();
        $divisions = Division::latest()->get();
        $ttcFilter = $request->input('ttc_name');
        $ttc = User::query();
        if ($ttcFilter) {
            $ttc->where('id', $ttcFilter);
        }
        $ttc_users = $ttc->where('user_type', 'ttc')->get();
        return view('admin.pages.ttc.index', compact('divisions', 'ttc_users', 'ttcUsers'));
    }

    public function getDistricts($divisionId)
    {
        $districts = District::where('division_id', $divisionId)->get();
        return response()->json($districts);
    }

    public function getUpazillas($districtId)
    {
        $upazillas = Upazilla::where('district_id', $districtId)->get();
        return response()->json($upazillas);
    }


     // Insert TTC
    public function storeTTC(Request $request)
    {

        try {
            // Validate incoming data
            $validatedData = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|string',
            ]);

            // Create a new TTC user record
            $user = User::create([
                'role_id' => 4,
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'username' => Str::slug($request->name).str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT),
                'password' => Hash::make('12345'),
                'user_type' => 'ttc',
                'status' => 1,
                'active_status' => 1,
            ]);

            // Create a new TTC others record in training_center_infos tables
            TrainingCenterInfo::create([
                'user_id' => $user->id,
                'division_id' => $request->division_id,
                'district_id' => $request->district_id,
                'upazilla_id' => $request->upazilla_id,
                'training_address' => $request->training_address,
            ]);

            return redirect()->back()->with('success', 'Registration successfully!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    // Update TTC
    public function updateTTC(Request $request, $id)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|string',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = User::findOrFail($id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->status = $request->input('status');
            $user->save();
            Toastr::success('TTC Update successfully!', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    // delete TTC
    public function destroyTTC($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            Toastr::success('TTC deleted successfully!', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }




}
