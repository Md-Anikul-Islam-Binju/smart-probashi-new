<?php

namespace App\Models\RecruitingAgency;

use App\Models\admin\District;
use App\Models\admin\Relation;
use App\Models\admin\Upazilla;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BmetCandidateContactInfo extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'user_id',
        'passport_info_id',
        'permanent_district_id',
        'permanent_upazilla_id',
        'mailing_district_id',
        'mailing_upazilla_id',
        'relation_id',
        'permanent_union',
        'permanent_village',
        'permanent_house',
        'mailing_union',
        'mailing_village',
        'mailing_house',
        'emergency_contact_person_name',
        'emergency_contact_person_phone',
        'status',
        'same_as'
    ];

    public function permanentDistrict(){
        return $this->belongsTo(District::class, 'permanent_district_id', 'id');
    }
    public function permanentUpazila()
    {
        return $this->belongsTo(Upazilla::class, 'permanent_upazilla_id', 'id');
    }

    public function mailingDistrict(){
        return $this->belongsTo(District::class, 'mailing_district_id', 'id');
    }
    public function mailingUpazila()
    {
        return $this->belongsTo(Upazilla::class, 'mailing_upazilla_id', 'id');
    }

    public function relation(){
        return $this->belongsTo(Relation::class, 'relation_id', 'id');
    }

    public function passportInfo()
    {
        return $this->belongsTo(CandidatePassportInfo::class, 'passport_info_id');
    }


}
