<?php

namespace App\Http\Controllers\RecruitingAgency;

use App\Http\Controllers\Controller;
use App\Models\RecruitingAgency\Clearance;
use App\Models\RecruitingAgency\JobClearance;
use Illuminate\Http\Request;

class ApplicationHistoryController extends Controller
{
    public function applicationHistory()
    {
        $jobUnderCandidateHistory = JobClearance::where('recruiting_agency_id', auth()->user()->id)->with('clearance','jobManagement.country','recruitingAgency')->get();
        return view('recruitingAgency.pages.bmetClearance.application_history', compact('jobUnderCandidateHistory'));
    }

    public function applicationHistoryStep($id)
    {
        $jobUnderCandidateHistoryDetails = JobClearance::where('id', $id)
             ->with('clearance.candidateClearances.passportInfo.visaInfo',
                    'clearance.candidateClearances.passportInfo.verificationInfo',
                    'clearance.candidateClearances.passportInfo.pdoInfo',
                    'clearance.candidateClearances.passportInfo.bankInfo',
                    'clearance.candidateClearances.passportInfo.medicalInfo',
                    'jobManagement.country',
                    'jobManagement.jobCategory',
                    'recruitingAgency',
                    'clearance.candidateClearancePayment')
            ->first();

        //dd($jobUnderCandidateHistoryDetails);
        return view('recruitingAgency.pages.bmetClearance.application_history_step', compact('jobUnderCandidateHistoryDetails'));
    }
}
