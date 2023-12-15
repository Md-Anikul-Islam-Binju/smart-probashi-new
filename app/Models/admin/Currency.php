<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = [
        'language_id',
        'country_name',
        'currency_name',
        'currency_symbol',
        'currency_code',
        'country_code',
        'exchange_rate',
        'status',
    ];

    //language
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

}
