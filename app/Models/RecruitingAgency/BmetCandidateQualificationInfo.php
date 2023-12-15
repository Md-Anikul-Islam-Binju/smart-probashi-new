<?php

namespace App\Models\RecruitingAgency;

use App\Models\admin\Board;
use App\Models\admin\Currency;
use App\Models\admin\EducationLevel;
use App\Models\admin\JobCategory;
use App\Models\admin\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BmetCandidateQualificationInfo extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'user_id',
        'passport_info_id',
        'education',
        'language',
        'desired_currency_id',
        'preferred_job_category_id',
        'status',
    ];


    public function educationLevel()
    {
        return $this->belongsTo(EducationLevel::class, 'education_level_id', 'id');
    }

    public function board()
    {
        return $this->belongsTo(Board::class, 'board_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id', 'id');
    }

    public function desiredCurrency()
    {
        return $this->belongsTo(Currency::class, 'desired_currency_id', 'id');
    }

    public function preferredJobCategory()
    {
        return $this->belongsTo(JobCategory::class, 'preferred_job_category_id', 'id');
    }

    public function passportInfo()
    {
        return $this->belongsTo(CandidatePassportInfo::class, 'passport_info_id');
    }


}
