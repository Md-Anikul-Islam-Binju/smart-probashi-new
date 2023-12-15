<?php

namespace App\Models\RecruitingAgency;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BmetCandidateVerificationInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'passport_info_id',
        'currency_id',
        'payment_status',
        'transaction_id',
        'transaction_amount',
        'payment_through',
        'candidate_verify_status',
        'registration_status',
        'bmet_verification_registration_no',
        'biometric_status',
    ];

    public function passportInfo()
    {
        return $this->belongsTo(CandidatePassportInfo::class, 'passport_info_id');
    }


}
