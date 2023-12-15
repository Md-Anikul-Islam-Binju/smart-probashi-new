<?php

namespace App\Http\Controllers\RecruitingAgency;

use App\Http\Controllers\Controller;
use App\Models\RecruitingAgency\Clearance;
use App\Models\RecruitingAgency\JobManagement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Toastr;

class DashboardController extends Controller
{
    public function dashboard(){

        $user = User::find(Auth::user()->id);

        if ($user->active_status == 0) {
            return view('recruitingAgency.pending-profile', compact('user'));
        }
        elseif ($user->active_status == 2) {
            return view('recruitingAgency.rejected-profile', compact('user'));
        }
        else{
            $jobs = JobManagement::where('recruiting_agencies_id', auth()->id())->where('status',3)->with('jobCategory','country')->withCount('attachedJobs')->latest()->limit(8)->get();
            $clearance = Clearance::where('recruiting_agency_id',Auth::id())->with('country', 'jobClearances.jobManagement', 'candidateClearances')
                ->latest()
                ->get();

            $clearanceCount = Clearance::where('dg_approved_status',1)->count();
            return view('recruitingAgency.dashboard', compact('jobs','clearance','clearanceCount'));
        }
    }

    public function profile(){
        $user = Auth::user();
        //$user = User::find(Auth::user()->id);
        return view('recruitingAgency.profile', compact('user'));
    }

    public function changePassword(Request $request)
    {

        $request->validate([
            'oldPassword' => 'required',
            'password' => 'required|min:8',
            'confirmPassword' => ['same:password'],
        ]);

        $userId = Auth::user()->id;
        $user = User::find($userId);

        if (Hash::check($request->oldPassword, $user->password)) {
            $user->password = bcrypt($request->password);
            $user->save();
            Auth::logout();
            return redirect()->back()->with('success', 'Changed Successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
