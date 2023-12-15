<?php

namespace App\Http\Controllers\RecruitingAgency;
use App\Http\Controllers\Controller;
use App\Models\admin\Currency;
use App\Models\admin\Religion;
use App\Models\admin\TrainingCenterInfo;
use App\Models\admin\TrainingSchedule;
use App\Models\RecruitingAgency\CandidatePassportInfo;
use App\Models\RecruitingAgency\PdoCandidateRegistration;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PdoCandidateRegistrationController extends Controller
{
    public function getPassportDetails(Request $request)
    {

        $passportNumber = $request->input('passport_no');
        $passportDetails = CandidatePassportInfo::where('recruiting_agencies_id', auth()->id())->where('passport_no', $passportNumber)->with('personalInfo')->first();
        if ($passportDetails) {
            return response()->json($passportDetails);
        } else {
            return response()->json(['error' => 'Passport not found'], 404);
        }
    }

    public function getSchedule($ttcId)
    {
        $schedule = TrainingSchedule::where('training_id', $ttcId)->where('available_sit','>',0)->get();
        return response()->json($schedule);
    }


    public function pdoCandidateRegistrationList(){
        $pdo_candidates = PdoCandidateRegistration::where('recruiting_agencies_id', auth()->id())->with('passportInfo','trainingSchedule','trainingCenter')->get();
        return view('recruitingAgency.pages.pdoRegistration.pdo_candidate_registration_list', compact('pdo_candidates'));
    }

    public function pdoRegistration(Request $request, $type = 'personal-info', $id = null)
    {
        $religion = Religion::latest()->get();
        $currency = Currency::latest()->get();
        $ttc= TrainingCenterInfo::with('trainingCenterByUser')->get();
        $pdoInfo = null;
        if ($id) {
            $pdoInfo = PdoCandidateRegistration::with('religion:id,religion_name','trainingSchedule','currency')->find($id);
        }
        if($request->isMethod('post'))
        {
            if ($type === 'personal-info') {
                if ($pdoInfo) {
                    // Validation
                    $validator = Validator::make($request->all(), [
                        'passport_no' => 'required|string|min:9|max:9|unique:pdo_candidate_registrations,passport_no',
                        'phone' => 'required|string|min:11|max:11',
                        'dob' => 'required|date',
                        'full_name' => 'required|string',
                        'gender' => 'required',
                    ]);
                    // Update existing personal info
                    $pdoInfo->update([
                        'passport_no' => $request->input('passport_no'),
                        'phone' => $request->input('phone'),
                        'dob' => $request->input('dob'),
                        'full_name' => $request->input('full_name'),
                        'gender' => $request->input('gender'),
                        'religion_id' => $request->input('religion_id'),
                        'fathers_name' => $request->input('fathers_name'),
                        'mothers_name' => $request->input('mothers_name'),
                        'nid_no' => $request->input('nid_no'),
                        'email' => $request->input('email'),
                        'passport_info_id'=>$request->input('passport_info_id'),
                    ]);
                } else {

                    // Validation
                    $request->validate([
                        'passport_no' => 'required|string|min:9|max:9|unique:pdo_candidate_registrations,passport_no',
                        'phone' => 'required|string|min:11|max:11',
                        'dob' => 'required|date',
                        'full_name' => 'required|string',
                        'gender' => 'required',
                    ]);
                    // Create new personal info
                    $pdoInfo = new PdoCandidateRegistration([
                        'recruiting_agencies_id' => Auth::id(),
                        'passport_no' => $request->input('passport_no'),
                        'phone' => $request->input('phone'),
                        'dob' => $request->input('dob'),
                        'full_name' => $request->input('full_name'),
                        'gender' => $request->input('gender'),
                        'religion_id' => $request->input('religion_id'),
                        'fathers_name' => $request->input('fathers_name'),
                        'mothers_name' => $request->input('mothers_name'),
                        'nid_no' => $request->input('nid_no'),
                        'email' => $request->input('email'),
                        'passport_info_id'=>$request->input('passport_info_id'),
                        'step_no'=>1,
                    ]);
                    $pdoInfo->save();
                }
            }elseif ($type === 'batch-info')
            {
                if ($pdoInfo) {
                    // Validation
                    $validator = Validator::make($request->all(), [
                        'training_center_id' => 'required',
                        'currency_id' => 'required',
                        'training_schedule_id' => 'required',
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }

                    $trainingScheduleId = $request->input('training_schedule_id');
                    TrainingSchedule::where('id', $trainingScheduleId)->decrement('available_sit', 1);
                    $batchInfo = PdoCandidateRegistration::updateOrCreate(
                        ['id' => $pdoInfo->id],
                        [
                            'training_center_id' => $request->input('training_center_id'),
                            'currency_id' => $request->input('currency_id'),
                            'training_schedule_id' => $request->input('training_schedule_id'),
                            'step_no' => 2,
                        ],

                    );
                }
              }
            elseif ($type === 'payment-info')
            {
                if ($pdoInfo) {
                    $paymentInfo = PdoCandidateRegistration::updateOrCreate(
                        ['id' => $pdoInfo->id],
                        [
                            'roll_no'=> mt_rand(1000000000, 9999999999),
                            'step_no' => 3,
                        ],
                    );
                }
            }elseif ($type === 'upload-photo')
            {
                if ($pdoInfo) {
                    $candidateImage = 'candidateImage';
                    if ($request->hasFile('photo')) {
                        $candidateImage = $request->file('photo')->store($candidateImage, 'public');
                    }else{
                        if ($pdoInfo) {
                            $candidateImage = $pdoInfo->photo;
                        } else {
                            $candidateImage = null;
                        }
                    }
                    $uploadInfo = PdoCandidateRegistration::updateOrCreate(
                        ['id' => $pdoInfo->id],
                        [
                            'photo' => $candidateImage ?? null,
                            'step_no' => 4,
                        ],
                    );
                }
            }
            $nextStep = $this->getNextStep($type);
            return redirect()->route('recruiting-agency.pdo.registration', ['type' => $nextStep, 'id' => $pdoInfo->id]);
        }
        return view('recruitingAgency.pages.pdoRegistration.pdo_registration',compact('type','id','religion','pdoInfo','ttc','currency'));
    }




    private function getNextStep($currentStep)
    {
        //Define the order of steps and their corresponding next steps
        $stepsOrder = [
            'personal-info' => 'batch-info',
            'batch-info' => 'payment-info',
            'payment-info' => 'upload-photo',
            'upload-photo' => 'enrollment-card',
            'enrollment-card' => null,
        ];
        return $stepsOrder[$currentStep] ?? 'personal-info';
    }


    public function pdoCandidateRegistrationPayment($pdoId)
    {
        return view('recruitingAgency.pages.pdoRegistration.pdo_registration_payment',compact('pdoId'));
    }


    public function pdoCandidateRegistrationPaymentStore(Request $request)
    {
        try {
            $paymentStatus = $request->input('payment_status');
            $fees = $request->input('fees');
            $paymentThrough = $request->input('payment_through');
            $pdoId = $request->input('pdoId');
            PdoCandidateRegistration::where('id', $pdoId)->update([
                'payment_status' => $paymentStatus,
                'fees' => $fees,
                'payment_through' => $paymentThrough,
            ]);
            return redirect()->route('recruiting-agency.pdo.registration', ['id' => $pdoId,'type' => 'payment-info']);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database error: ' . $e->getMessage()], 500);
        }
    }

    public function pdoCandidateDownloadCardList()
    {
        $pdo_candidates = PdoCandidateRegistration::where('recruiting_agencies_id', auth()->id())->where('payment_status',1)->where('step_no',4)->with('passportInfo','trainingSchedule','trainingCenter')->get();
        return view('recruitingAgency.pages.pdoRegistration.pdo_candidate_certificate_download',compact('pdo_candidates'));
    }

}

