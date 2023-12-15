<?php

namespace App\Http\Controllers\RecruitingAgency;

use App\Http\Controllers\Controller;
use App\Models\RecruitingAgency\Clearance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OngoingApplicationController extends Controller
{
    public function ongoingApplication()
    {
        $clearance = Clearance::where('recruiting_agency_id',Auth::id())->with('country', 'jobClearances.jobManagement', 'candidateClearances')
                     ->latest()
                     ->get();
        return view('recruitingAgency.pages.bmetClearance.ongoing_applications',compact('clearance'));
    }

    public function ongoingApplicationStep($id)
    {
        $clearance = Clearance::where('id',$id)->with('country',
            'jobClearances.jobManagement',
            'jobClearances.jobManagement.jobCategory',
            'candidateClearances.passportInfo',
            'candidateClearances.passportInfo.verificationInfo',
            'candidateClearances.passportInfo.pdoInfo',
            'candidateClearances.passportInfo.visaInfo',
            'candidateClearances.job',
            'candidateClearances.job.jobCategory',
            'candidateClearances.passportInfo.medicalInfo',
            'candidateClearancePayment')
            ->first();
        return view('recruitingAgency.pages.bmetClearance.ongoing_application_step',compact('clearance'));
    }
}
