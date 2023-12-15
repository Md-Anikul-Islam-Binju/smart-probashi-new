<?php

namespace App\Models\RecruitingAgency;

use App\Models\admin\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecruitingAgencyInfo extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'user_id',
        'organization_id',
        'currency_id',
        'recruiting_agency_portal_access',
        'designation',
        'trade_license',
        'recruiting_license',
        'business_card',
        'gender',
        'foreign_organization_name',
        'foreign_organization_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }
}
