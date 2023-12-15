<?php

namespace App\Models\RecruitingAgency;

use App\Models\admin\District;
use App\Models\admin\Relation;
use App\Models\admin\Religion;
use App\Models\admin\Upazilla;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BmetCandidateNomineeInfo extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'user_id',
        'passport_info_id',
        'nominee_relation_id',
        'nominee_district_id',
        'nominee_upazilla_id',
        'nominee_name',
        'nominee_nid',
        'nominee_phone',
        'nominee_fathers_name',
        'nominee_mothers_name',
        'nominee_union',
        'nominee_village',
        'nominee_house',
        'same_as',
        'status',

    ];

    //relation
    public function relation(): BelongsTo
    {
        return $this->belongsTo(Relation::class, 'nominee_relation_id', 'id');
    }

    public function nomineeDistrict()
    {
        return $this->belongsTo(District::class, 'nominee_district_id', 'id');
    }

    public function nomineeUpazila()
    {
        return $this->belongsTo(Upazilla::class, 'nominee_upazilla_id', 'id');
    }

    public function passportInfo()
    {
        return $this->belongsTo(CandidatePassportInfo::class, 'passport_info_id');
    }


}
