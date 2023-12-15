<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('training_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('training_id')->nullable();
            $table->string('batch_no')->nullable();
            $table->date('training_start_date')->nullable();
            $table->date('training_end_date')->nullable();
            $table->time('training_start_time')->nullable();
            $table->time('training_end_time')->nullable();
            $table->integer('pdo_type')->nullable()->comment('1 = General Category, 2 = VIP Category, 3 = Others Category');
            $table->integer('number_of_seats')->nullable();
            $table->integer('available_sit')->nullable();
            $table->integer('booking_sit')->nullable();
            $table->double('training_fees', 8, 2)->nullable();
            $table->string('room_no')->nullable();
            $table->integer('status')->default(1)->comment('1 = active, 0 = inactive')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_schedules');
    }
};
