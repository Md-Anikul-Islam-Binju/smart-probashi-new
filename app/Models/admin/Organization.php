<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use SoftDeletes, HasFactory;
     protected $fillable = [
        'name_en',
        'name_bn',
        'recruiting_license_no',
        'address_en',
        'address_bn',
        'status',
      ];
}
