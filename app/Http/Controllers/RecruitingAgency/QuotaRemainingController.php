<?php

namespace App\Http\Controllers\RecruitingAgency;

use App\Http\Controllers\Controller;
use App\Models\RecruitingAgency\Clearance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuotaRemainingController extends Controller
{
    public function quotaRemaining()
    {
        $clearance = Clearance::where('recruiting_agency_id',Auth::id())->with('country', 'jobClearances.jobManagement', 'candidateClearances')
            ->latest()
            ->get();
        return view('recruitingAgency.pages.bmetClearance.quota_remaining',compact('clearance'));
    }
}
