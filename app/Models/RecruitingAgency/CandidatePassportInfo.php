<?php

namespace App\Models\RecruitingAgency;

use App\Models\admin\Currency;
use App\Models\admin\District;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CandidatePassportInfo extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'recruiting_agencies_id',
        'user_id',
        'currency_id',
        'district_id',
        'passport_no',
        'nid_no',
        'full_name',
        'fathers_name',
        'mothers_name',
        'phone',
        'passport_image',
        'gender',
        'dob',
        'passport_issue_date',
        'passport_expiry_date',
        'status',
    ];

    //district
    public function district(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    //currency
    public function currency(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    //verified info
    public function verificationInfo(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(BmetCandidateVerificationInfo::class, 'passport_info_id');
    }

    //contact information
    public function contactInfo(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(BmetCandidateContactInfo::class, 'passport_info_id');
    }

    //nominee information
    public function nomineeInfo(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(BmetCandidateNomineeInfo::class, 'passport_info_id');
    }

    //personal information
    public function personalInfo(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(BmetCandidatePersonalInfo::class, 'passport_info_id');
    }

    //qualification information
    public function qualificationInfo(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(BmetCandidateQualificationInfo::class, 'passport_info_id');
    }

    //job
    public function jobAttached(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(JobAttached::class, 'passport_info_id');
    }

    public function recruitingAgency()
    {
        return $this->belongsTo(User::class, 'recruiting_agencies_id', 'id');
    }

    public function pdoInfo()
    {
        return $this->hasOne(PdoCandidateRegistration::class, 'passport_info_id', 'id');
    }

    public function visaInfo()
    {
        return $this->hasOne(VisaInfo::class, 'passport_info_id', 'id');
    }

    public function bankInfo()
    {
        return $this->hasOne(BankInfo::class, 'passport_info_id', 'id');
    }

    public function medicalInfo()
    {
        return $this->hasOne(MedicalInfo::class, 'passport_info_id', 'id');
    }

}
