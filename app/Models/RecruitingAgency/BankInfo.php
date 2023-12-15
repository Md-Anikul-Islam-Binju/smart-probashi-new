<?php

namespace App\Models\RecruitingAgency;

use App\Models\admin\Bank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankInfo extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = [
        'passport_info_id',
        'bank_id',
        'account_holder_name',
        'account_number',
        'proof_of_bank_account_file',
        'status',
    ];

    public function passportInfo()
    {
        return $this->belongsTo(CandidatePassportInfo::class, 'passport_info_id', 'id');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id', 'id');
    }
}
