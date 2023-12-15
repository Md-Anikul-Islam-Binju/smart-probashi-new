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
        Schema::create('bmet_candidate_contact_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('passport_info_id')->nullable();
            $table->unsignedBigInteger('permanent_district_id')->nullable();
            $table->unsignedBigInteger('permanent_upazilla_id')->nullable();
            $table->unsignedBigInteger('mailing_district_id')->nullable();
            $table->unsignedBigInteger('mailing_upazilla_id')->nullable();
            $table->unsignedBigInteger('relation_id')->nullable()->comment('relation with emergency contact person');
            $table->string('permanent_union')->nullable();
            $table->string('permanent_village')->nullable();
            $table->string('permanent_house')->nullable();
            $table->string('mailing_union')->nullable();
            $table->string('mailing_village')->nullable();
            $table->string('mailing_house')->nullable();
            $table->string('emergency_contact_person_name')->nullable();
            $table->string('emergency_contact_person_phone')->nullable();
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
        Schema::dropIfExists('bmet_candidate_contact_infos');
    }
};
