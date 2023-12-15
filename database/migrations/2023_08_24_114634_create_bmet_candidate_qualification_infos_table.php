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
        Schema::create('bmet_candidate_qualification_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('passport_info_id')->nullable();
            $table->unsignedBigInteger('education_level_id')->nullable();
            $table->unsignedBigInteger('board_id')->nullable();
            $table->unsignedBigInteger('language_id')->nullable();
            $table->string('desired_currency_id')->nullable();
            $table->string('preferred_job_category_id')->nullable();
            $table->string('passing_year')->nullable();
            $table->string('subject')->nullable();
            $table->string('institute')->nullable();
            $table->string('grade')->nullable();
            $table->string('language_oral_skill')->nullable();
            $table->string('language_writing_skill')->nullable();
            $table->boolean('status')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bmet_candidate_qualification_infos');
    }
};
