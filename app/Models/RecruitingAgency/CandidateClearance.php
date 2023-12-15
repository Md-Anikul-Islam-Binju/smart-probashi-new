<?php

namespace App\Models\RecruitingAgency;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CandidateClearance extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = [
        'job_clearance_id',
        'application_no',
        'job_id',
        'passport_info_id',
        'recruiting_agency_id',
        'status',
    ];

    public function jobClearance()
    {
        return $this->belongsTo(JobClearance::class, 'job_clearance_id', 'id');
    }

    public function passportInfo()
    {
        return $this->belongsTo(CandidatePassportInfo::class, 'passport_info_id', 'id');
    }

    public function job()
    {
        return $this->belongsTo(JobManagement::class, 'job_id', 'id');
    }





}
