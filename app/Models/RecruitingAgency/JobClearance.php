<?php

namespace App\Models\RecruitingAgency;

use App\Http\Middleware\RecruitingAgency;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobClearance extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = [
        'clearance_id',
        'job_id',
        'recruiting_agency_id',
        'status',
    ];

    public function clearance()
    {
        return $this->belongsTo(Clearance::class, 'clearance_id', 'id');
    }

    public function jobManagement()
    {
        return $this->hasOne(JobManagement::class, 'id', 'job_id');
    }

    public function recruitingAgency()
    {
        return $this->belongsTo(User::class, 'recruiting_agency_id', 'id');
    }
}
