<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use App\Models\RecruitingAgency\RecruitingAgencyInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Toastr;
class RecruitingAgencyController extends Controller
{
    public function all()
    {
        $allRecruitingAgency = User::where('role_id',3)->with('recruitingAgencyInfo.organization')->get();
        return view('admin.pages.recruiting_agency.all_recruiting_agency', compact('allRecruitingAgency'));
    }

    public function show($id){

        $recruitingAgency = User::where('role_id',3)->with('recruitingAgencyInfo.organization')->find($id);
        return view('admin.pages.recruiting_agency.show_recruiting_agency', compact('recruitingAgency'));
    }

    public function approved()
    {
        $approvedRecruitingAgency = User::where('role_id',3)->where('active_status',1)->with('recruitingAgencyInfo.organization')->get();
        return view('admin.pages.recruiting_agency.approved_recruiting_agency', compact('approvedRecruitingAgency'));
    }

    public function pending()
    {
        $pendingRecruitingAgency = User::where('role_id',3)->where('active_status',0)->with('recruitingAgencyInfo.organization')->get();
        return view('admin.pages.recruiting_agency.pending_recruiting_agency', compact('pendingRecruitingAgency'));
    }

    public function rejected()
    {
        $rejectRecruitingAgency = User::where('role_id',3)->where('active_status',2)->with('recruitingAgencyInfo.organization')->get();
        return view('admin.pages.recruiting_agency.rejected_recruiting_agency', compact('rejectRecruitingAgency'));
    }


    public function approvedRecruitingAgency($id)
    {
        $recruitingAgency = User::find($id);
        if ($recruitingAgency) {
            $recruitingAgency->update(['active_status' => 1]);
            Toastr::success('Recruiting Agency Approved successfully!', 'Success');
        } else {
            Toastr::error('Recruiting Agency not found!', 'Error');
        }

        return redirect()->back();
    }

    public function rejectRecruitingAgency($id)
    {
        $recruitingAgency = User::find($id);
        if ($recruitingAgency) {
            $recruitingAgency->update(['active_status' => 2]);
            Toastr::success('Recruiting Agency Rejected successfully!', 'Success');
        } else {
            Toastr::error('Recruiting Agency not found!', 'Error');
        }

        return redirect()->back();
    }
}
