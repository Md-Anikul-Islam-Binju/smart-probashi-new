<?php

namespace App\Models\RecruitingAgency;

use App\Models\admin\Religion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BmetCandidatePersonalInfo extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'user_id',
        'passport_info_id',
        'religion_id',
        'fathers_name',
        'mothers_name',
        'marital_status',
        'spouse_name',
        'height_feet',
        'height_inch',
        'weight',
        'status',
    ];

    //religion
    public function religion(){
        return $this->belongsTo(Religion::class, 'religion_id', 'id');
    }

    public function passportInfo()
    {
        return $this->belongsTo(CandidatePassportInfo::class, 'passport_info_id');
    }




}
