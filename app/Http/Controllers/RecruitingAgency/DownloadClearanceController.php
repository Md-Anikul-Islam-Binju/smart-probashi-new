<?php

namespace App\Http\Controllers\RecruitingAgency;

use App\Http\Controllers\Controller;
use App\Models\RecruitingAgency\CandidateClearance;
use App\Models\RecruitingAgency\Clearance;
use BaconQrCode\Writer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
class DownloadClearanceController extends Controller
{
    public function downloadApplication()
    {
        $clearance = Clearance::where('recruiting_agency_id',Auth::id())->with('country', 'jobClearances.jobManagement', 'candidateClearances')
                    ->latest()
                    ->get();
        return view('recruitingAgency.pages.bmetClearance.download_bmet_clearance',compact('clearance'));
    }

    public function downloadApplicationCandidate($id)
    {
        $clearance = Clearance::where('id',$id)->with('country',
            'candidateClearances.passportInfo',
            'candidateClearances.job.jobCategory',
            'candidateClearances.passportInfo.verificationInfo')
            ->first();
        return view('recruitingAgency.pages.bmetClearance.download_bmet_clearance_candidate_list',compact('clearance'));
    }

    public function printCandidateApplications($id)
    {
        $card = CandidateClearance::where('id',$id)->with('passportInfo.personalInfo','passportInfo.pdoInfo','passportInfo.recruitingAgency')->first();
        $dynamicLink = URL::temporarySignedRoute(
            'candidate.card.verify',
            now()->addMinutes(30),
            ['id' => $id]
        );
        $renderer = new \BaconQrCode\Renderer\Image\Png();
        $renderer->setHeight(200);
        $renderer->setWidth(200);
        $writer = new Writer($renderer);
        try {
            $qrCode = $writer->writeString($dynamicLink);
        } catch (\Exception $e) {
            $e->getMessage();
        }
        return view('recruitingAgency.pages.bmetClearance.download_bmet_clearance_candidate_card',compact('card','dynamicLink','qrCode'));
    }


    public function downloadCandidateCard($id)
    {
        $card = CandidateClearance::where('id', $id)->with('passportInfo.personalInfo', 'passportInfo.pdoInfo', 'passportInfo.recruitingAgency')->first();
        $dynamicLink = URL::temporarySignedRoute(
            'candidate.card.verify',
            now()->addMinutes(30),
            ['id' => $id]
        );
        $renderer = new \BaconQrCode\Renderer\Image\Png();
        $renderer->setHeight(200);
        $renderer->setWidth(200);
        $writer = new Writer($renderer);
        try {
            $qrCode = $writer->writeString($dynamicLink);
        } catch (\Exception $e) {
            $e->getMessage();
        }
        $pdf = PDF::loadView('recruitingAgency.pages.bmetClearance.download_bmet_clearance_candidate_card', compact('card', 'dynamicLink', 'qrCode'));
        return $pdf->download('candidate_card.pdf');
    }




    public function printCandidateApplicationsVerify($id)
    {
        $clearance = CandidateClearance::where('id',$id)->with('passportInfo.personalInfo','passportInfo.verificationInfo','passportInfo.pdoInfo','passportInfo.visaInfo','passportInfo.recruitingAgency','job.country')->first();
        return view('recruitingAgency.pages.bmetClearance.download_bmet_clearance_candidate_card_verify',compact('clearance'));
    }
}
