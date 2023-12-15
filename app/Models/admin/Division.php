<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = [
        'division_name_en',
        'division_name_bn',
        'status',
    ];

    public function districts() {
        return $this->hasMany(District::class);
    }

}
