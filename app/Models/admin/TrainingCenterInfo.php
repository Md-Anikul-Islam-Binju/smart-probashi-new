<?php

namespace App\Models\admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrainingCenterInfo extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'user_id',
        'division_id',
        'district_id',
        'upazilla_id',
        'trade_license',
        'business_card',
        'others_document_one',
        'others_document_two',
        'training_address',
    ];

    public function trainingCenterByUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
