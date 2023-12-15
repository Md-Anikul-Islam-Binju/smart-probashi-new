<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\RecruitingAgency\BmetCandidateVerificationInfo;
use App\Models\RecruitingAgency\CandidatePassportInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Toastr;
class BmetRegistrationController extends Controller
{
    public function index()
    {
        $bmet_users = User::where('role_id', 2)->get();
        return view('admin.pages.bmet.index',compact('bmet_users'));
    }

    public function store(Request $request)
    {
        try {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->password = bcrypt($request->input('password'));
            // Generate a unique username (name slug + 3-digit random number)
            $baseUsername = Str::slug($user->name);
            $randomNumber = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
            $user->username = $baseUsername . $randomNumber;
            $user->role_id = 2;
            $user->user_type = 'bmet';
            $user->save();
            Toastr::success('BMET Registration successfully!', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->status = $request->input('status');
            $baseUsername = Str::slug($user->name);
            $randomNumber = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
            $user->username = $baseUsername . $randomNumber;
            $user->save();
            Toastr::success('BMET Registration successfully!', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    //delete
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            Toastr::success('BMET Registration deleted successfully!', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


    //BMET Candidate Registration verification
    public function registeredVerificationCandidateList()
    {
        $passportInfos = CandidatePassportInfo::with('verificationInfo','recruitingAgency')->latest()->get();
        return view('admin.pages.bmet.bmet_candidate_registration_list',compact('passportInfos'));
    }

    public function registeredCandidateDetails($id)
    {
        $passportDetailsInfos = CandidatePassportInfo::where('id',$id)->with('personalInfo','personalInfo.religion','contactInfo',
            'contactInfo.permanentDistrict', 'contactInfo.permanentUpazila', 'contactInfo.mailingDistrict','contactInfo.mailingUpazila','contactInfo.relation',
            'nomineeInfo','nomineeInfo.nomineeDistrict','nomineeInfo.nomineeUpazila','nomineeInfo.relation',
            'qualificationInfo','qualificationInfo.educationLevel','qualificationInfo.board','qualificationInfo.language','verificationInfo')->first();

        //dd($passportDetailsInfos);
        return view('admin.pages.bmet.bmet_candidate_registration_details',compact('passportDetailsInfos'));
    }
    public function registeredVerificationApproved($id)
    {
        BmetCandidateVerificationInfo::where('passport_info_id',$id)->update(['registration_status'=> 1]);
        return redirect()->back()->with('success','Candidate Approved Successfully');
    }

    public function registeredVerificationNotApproved($id)
    {
        BmetCandidateVerificationInfo::where('passport_info_id',$id)->update(['registration_status'=> 0]);
        return redirect()->back()->with('danger','Candidate Reject Successfully');
    }






}
