<?php

namespace App\Models\RecruitingAgency;

use App\Http\Middleware\RecruitingAgency;
use App\Models\admin\Currency;
use App\Models\admin\JobCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobManagement extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'recruiting_agencies_id',
        'category_id',
        'sector',
        'no_of_post',
        'no_of_post_already_finished',
        'employee_name',
        'country_id',
        'city_name',
        'bmet_reference_no',
        'job_type',
        'foreign_reference_no',
        'foreign_reference_date',
        'ministry_reference_no',
        'ministry_reference_date',
        'skill_type',
        'gender',
        'min_age',
        'max_age',
        'description_en',
        'description_bn',
        'salary_amount',
        'currency_id',
        'salary_per',
        'is_accommodation',
        'is_food',
        'is_transport',
        'is_medical',
        'is_visa',
        'is_insurance',
        'contract_tenure',
        'probation_period',
        'requirements_details',
        'benefits_details',
        'condition_details',
        'additional_details',
        'application_deadline',
        'employer_deadline',
        'employment_permit_file',
        'demand_latter_file',
        'work_agreement_file',
        'other_file',
        'employer_address',
        'working_duration',
        'working_days',
        'working_on',
        'is_one_way',
        'is_two_way',
        'is_other',
        'status',
    ];

    public function jobCategory()
    {
        return $this->belongsTo(JobCategory::class,'category_id');
    }
    public function country()
    {
       return $this->belongsTo(Currency::class,'country_id');
    }

    public function attachedJobs()
    {
        return $this->hasMany(JobAttached::class, 'job_id', 'id');
    }

    public function recruitingAgency()
    {
        return $this->belongsTo(User::class, 'recruiting_agencies_id', 'id');
    }

    public function jobClearances()
    {
        return $this->hasMany(JobClearance::class, 'job_id', 'id');
    }




}
