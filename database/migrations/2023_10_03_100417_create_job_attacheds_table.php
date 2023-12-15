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
        Schema::create('job_attacheds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('passport_info_id')->nullable();
            $table->unsignedBigInteger('job_id')->nullable();
            $table->string('job_category_name')->nullable();
            $table->string('status')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_attacheds');
    }
};
