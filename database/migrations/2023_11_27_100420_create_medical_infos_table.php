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
        Schema::create('medical_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('passport_info_id')->nullable();
            $table->integer('hospital_id')->nullable();
            $table->string('medical_clearance_file')->nullable();
            $table->integer('status')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_infos');
    }
};
