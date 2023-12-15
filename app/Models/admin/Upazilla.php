<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upazilla extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = [
        'district_id',
        'upazila_name_en',
        'upazila_name_bn',
        'status',
    ];

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
}
