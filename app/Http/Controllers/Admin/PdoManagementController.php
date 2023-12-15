<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\TrainingCenterInfo;
use App\Models\RecruitingAgency\PdoCandidateRegistration;
use App\Models\User;
use Illuminate\Http\Request;

class PdoManagementController extends Controller
{
    public function pdoRegisterCandidateList(Request $request)
    {
        $ttcUsers = TrainingCenterInfo::with('trainingCenterByUser')->get();
        $ttcFilter = $request->input('ttc');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $pdo_candidates = PdoCandidateRegistration::query();
        if ($ttcFilter) {
            $pdo_candidates->where('training_center_id', $ttcFilter);
        }

        if ($start_date && $end_date) {
            $pdo_candidates->whereHas('trainingSchedule', function ($query) use ($start_date, $end_date) {
                $query->whereBetween('training_start_date', [$start_date, $end_date])
                    ->orWhereBetween('training_end_date', [$start_date, $end_date]);
            });
        }

        $pdo_candidates = $pdo_candidates->with('passportInfo','trainingSchedule','trainingCenter','recruitingAgency')->paginate(10);
        return view('admin.pages.pdo.pdo_register_candidate_list',compact('pdo_candidates','ttcUsers'));
    }

    public function pdoRegisterCandidateDetails($id)
    {
        $pdoInfo = PdoCandidateRegistration::where('id',$id)->with('passportInfo','trainingSchedule','trainingCenter','recruitingAgency')->find($id);
        return view('admin.pages.pdo.pdo_register_candidate_details',compact('pdoInfo'));
    }

//    public function pdoRegisteredVerificationApproved($id)
//    {
//        PdoCandidateRegistration::where('id',$id)->update(['approval_status'=> 1]);
//        return redirect()->back()->with('success','PDO Candidate Approved Successfully');
//    }

    public function pdoRegisteredVerificationApproved($id)
    {
        $applicationNo = 'PDOC-' . now()->format('ymdHis');
        PdoCandidateRegistration::where('id', $id)->update([
            'approval_status' => 1,
            'certificate_no' => $applicationNo,
            'training_status' => 1,
            'certificate_status' => 1,
        ]);
        return redirect()->back()->with('success', 'PDO Candidate Approved Successfully');
    }


    public function pdoRegisteredVerificationNotApproved($id)
    {
        PdoCandidateRegistration::where('id',$id)->update(['approval_status'=> 0]);
        return redirect()->back()->with('danger','PDO Candidate Reject Successfully');
    }
}
