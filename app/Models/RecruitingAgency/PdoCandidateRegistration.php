<?php

namespace App\Models\RecruitingAgency;

use App\Models\admin\Currency;
use App\Models\admin\Religion;
use App\Models\admin\TrainingCenterInfo;
use App\Models\admin\TrainingSchedule;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PdoCandidateRegistration extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'recruiting_agencies_id',
        'user_id',
        'passport_info_id',
        'training_center_id',
        'training_schedule_id',
        'currency_id',
        'passport_no',
        'full_name',
        'fathers_name',
        'mothers_name',
        'dob',
        'gender',
        'religion_id',
        'nid_no',
        'phone',
        'email',
        'fees',
        'payment_status',
        'transaction_id',
        'transaction_amount',
        'payment_through',
        'photo',
        'approval_status',
        'roll_no',
        'candidate_user_id',
        'certificate_no',
        'training_status',
        'certificate_status',
        'step_no',
    ];

    public function passportInfo()
    {
        return $this->belongsTo(CandidatePassportInfo::class, 'passport_info_id');
    }
    public function religion(){
        return $this->belongsTo(Religion::class, 'religion_id', 'id');
    }

    public function trainingCenter()
    {
        return $this->belongsTo(TrainingCenterInfo::class, 'training_center_id');
    }

    public function trainingSchedule()
    {
        return $this->belongsTo(TrainingSchedule::class, 'training_schedule_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function recruitingAgency()
    {
        return $this->belongsTo(User::class, 'recruiting_agencies_id', 'id');
    }

}
