<?php

namespace App\Http\Controllers\BMET;

use App\Http\Controllers\Controller;
use App\Models\RecruitingAgency\BmetCandidateVerificationInfo;
use App\Models\RecruitingAgency\CandidatePassportInfo;
use Illuminate\Http\Request;

class RegisteredCandidateController extends Controller
{
    public function registeredCompletedCandidateList()
    {
        $passportInfos = CandidatePassportInfo::with('verificationInfo')
            ->whereHas('verificationInfo', function ($query) {
                $query->where('registration_status', 1);
            })
            ->latest()
            ->get();
        return view('bmet.pages.candidate_registration_list',compact('passportInfos'));
    }


    public function bmetRegisteredCandidateDetails($id)
    {
        $passportDetailsInfos = CandidatePassportInfo::where('id',$id)->with('personalInfo','personalInfo.religion','contactInfo',
            'contactInfo.permanentDistrict', 'contactInfo.permanentUpazila', 'contactInfo.mailingDistrict','contactInfo.mailingUpazila','contactInfo.relation',
            'nomineeInfo','nomineeInfo.nomineeDistrict','nomineeInfo.nomineeUpazila','nomineeInfo.relation',
            'qualificationInfo','qualificationInfo.educationLevel','qualificationInfo.board','qualificationInfo.language','verificationInfo')->first();
        return view('bmet.pages.candidate_regestration_details',compact('passportDetailsInfos'));
    }



//    public function registeredApproved($id)
//    {
//        BmetCandidateVerificationInfo::where('passport_info_id',$id)->update(['candidate_verify_status'=> 1]);
//        return redirect()->back()->with('success','Candidate Approved Successfully');
//    }


    public function registeredApproved($id)
    {
        BmetCandidateVerificationInfo::where('passport_info_id', $id)->update(['candidate_verify_status' => 1]);
        $randomRegistrationNo = $this->getRandomRegistrationNumber();
        BmetCandidateVerificationInfo::where('passport_info_id', $id)->update([
            'bmet_verification_registration_no' => $randomRegistrationNo,
            'biometric_status' => 1
        ]);
        return redirect()->back()->with('success', 'Candidate Approved Successfully');
    }


    private function getRandomRegistrationNumber()
    {
        $prefix = 'CPM';
        $randomNumber = mt_rand(100000, 999999);
        $randomCharacter = chr(mt_rand(65, 90)); // ASCII value for A-Z
        return $prefix . $randomNumber . $randomCharacter;
    }


    public function registeredNotApproved($id)
    {
        BmetCandidateVerificationInfo::where('passport_info_id',$id)->update(['candidate_verify_status'=> 0]);
        return redirect()->back()->with('danger','Candidate Reject Successfully');
    }


}
