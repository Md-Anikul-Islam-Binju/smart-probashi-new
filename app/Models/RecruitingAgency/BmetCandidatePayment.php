<?php

namespace App\Models\RecruitingAgency;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BmetCandidatePayment extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'user_id',
        'passport_info_id',
        'payment_method',
        'payable_amount',
        'status',
    ];
}
