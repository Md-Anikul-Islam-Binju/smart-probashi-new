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
        Schema::create('job_clearances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clearance_id')->nullable();
            $table->integer('job_id')->nullable();
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
        Schema::dropIfExists('job_clearances');
    }
};
