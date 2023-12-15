<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'division_id',
        'district_name_en',
        'district_name_bn',
        'status',
    ];

    //relation with division
    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }

    public function upazilas() {
        return $this->hasMany(Upazilla::class);
    }
}
