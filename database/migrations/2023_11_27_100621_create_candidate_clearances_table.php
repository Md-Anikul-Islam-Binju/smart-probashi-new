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
        Schema::create('candidate_clearances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_clearance_id')->nullable();
            $table->string('application_no')->nullable();
            $table->integer('job_id')->nullable();
            $table->integer('passport_info_id')->nullable();
            $table->integer('recruiting_agency_id')->nullable();
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
        Schema::dropIfExists('candidate_clearances');
    }
};
