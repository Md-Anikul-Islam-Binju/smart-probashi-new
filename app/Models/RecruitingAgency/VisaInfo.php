<?php

namespace App\Models\RecruitingAgency;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisaInfo extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = [
        'passport_info_id',
        'visa_no',
        'sticker_no',
        'visa_reference_no',
        'visa_issue_date',
        'visa_expiry_date',
        'sponsor_id',
        'attestation_ref_no',
        'attestation_ref_date',
        'visa_file',
        'employment_contract_file',
        'status',
    ];

    public function passportInfo()
    {
        return $this->belongsTo(CandidatePassportInfo::class, 'passport_info_id');
    }
}
