<?php

namespace App\Models\admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrainingSchedule extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
          'training_id',
          'batch_no',
          'training_start_date',
          'training_end_date',
          'training_start_time',
          'training_end_time',
          'pdo_type',
          'number_of_seats',
          'available_sit',
          'booking_sit',
          'training_fees',
          'room_no',
          'status',
    ];
      public function trainingCenter()
      {
            return $this->belongsTo(TrainingCenterInfo::class, 'training_id', 'id');
      }




}
