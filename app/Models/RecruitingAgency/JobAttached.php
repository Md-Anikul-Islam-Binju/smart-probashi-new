<?php

namespace App\Models\RecruitingAgency;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobAttached extends Model
{
    use SoftDeletes, HasFactory;


    protected $fillable = [
        'recruiting_agencies_id',
        'passport_info_id',
        'job_id',
        'job_category_name',
        'status',
    ];

    public function passportInfo()
    {
        return $this->belongsTo(CandidatePassportInfo::class, 'passport_info_id');
    }

    public function job()
    {
        return $this->belongsTo(JobManagement::class, 'job_id');
    }



}
