<?php

namespace App\Models\RecruitingAgency;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClearancePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'clearance_id',
        'payment_type',
        'advance_tax',
        'service_charge',
        'insurance_fee',
        'total_candidate_payment',
        'total_payment',
        'payment_status',
    ];

    public function clearance()
    {
        return $this->belongsTo(Clearance::class, 'clearance_id', 'id' );
    }
}
