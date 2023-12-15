<?php

namespace App\Models\RecruitingAgency;

use App\Models\admin\Hospital;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalInfo extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = [
        'passport_info_id',
        'hospital_id',
        'medical_clearance_file',
        'status',
    ];

    public function passportInfo()
    {
        return $this->belongsTo(CandidatePassportInfo::class, 'passport_info_id', 'id');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id', 'id');
    }
}
