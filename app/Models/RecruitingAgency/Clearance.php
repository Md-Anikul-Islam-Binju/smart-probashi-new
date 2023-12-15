<?php

namespace App\Models\RecruitingAgency;
use App\Models\admin\Currency;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clearance extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = [
        'country_id',
        'application_no',
        'clearance_type',
        'recruiting_agency_id',
        'foreign_ref_no',
        'foreign_ref_date',
        'ministry_ref_no',
        'ministry_ref_date',
        'bmet_reference_no',
        'bmet_reference_date',
        'status',
        'section_name',
        'section_approved_status',
        'section_sign',
        'section_date',
        'translator_name',
        'translator_approved_status',
        'translator_sign',
        'translator_date',
        'ad_name',
        'ad_approved_status',
        'ad_sign',
        'ad_date',
        'dd_name',
        'dd_approved_status',
        'dd_sign',
        'dd_date',
        'd_name',
        'd_approved_status',
        'd_sign',
        'd_date',
        'adg_name',
        'adg_approved_status',
        'adg_sign',
        'adg_date',
        'dg_name',
        'dg_approved_status',
        'dg_sign',
        'dg_date',
    ];
    public function country()
    {
        return $this->belongsTo(Currency::class, 'country_id', 'id' );
    }

    public function recruitingAgency()
    {
        return $this->belongsTo(User::class, 'recruiting_agency_id', 'id');
    }
    public function jobClearances()
    {
        return $this->hasMany(JobClearance::class, 'clearance_id', 'id');
    }

    public function candidateClearances()
    {
        return $this->hasMany(CandidateClearance::class, 'job_clearance_id', 'id');
    }

    public function candidateClearancePayment()
    {
        return $this->hasOne(ClearancePayment::class, 'clearance_id', 'id');
    }
}
