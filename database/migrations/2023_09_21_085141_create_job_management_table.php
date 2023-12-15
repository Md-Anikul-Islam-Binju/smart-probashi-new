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
        Schema::create('job_management', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recruiting_agencies_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->string('sector')->nullable();
            $table->integer('no_of_post')->nullable();
            $table->integer('no_of_post_already_finished')->nullable();
            $table->string('city_name')->nullable();
            $table->string('employee_name')->nullable();
            $table->string('bmet_reference_no')->nullable();
            $table->string('foreign_reference_no')->nullable();
            $table->date('foreign_reference_date')->nullable();
            $table->string('job_type')->nullable();
            $table->string('ministry_reference_no')->nullable();
            $table->date('ministry_reference_date')->nullable();
            $table->string('skill_type')->nullable();
            $table->string('gender')->nullable();
            $table->integer('min_age')->nullable();
            $table->integer('max_age')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_bn')->nullable();
            $table->string('salary_amount')->nullable();
            $table->string('salary_per')->nullable();
            $table->integer('is_accommodation')->default(0)->nullable();
            $table->integer('is_food')->default(0)->nullable();
            $table->integer('is_transport')->default(0)->nullable();
            $table->integer('is_medical')->default(0)->nullable();
            $table->integer('is_visa')->default(0)->nullable();
            $table->integer('is_insurance')->default(0)->nullable();
            $table->string('contract_tenure')->nullable();
            $table->string('probation_period')->nullable();
            $table->text('requirements_details')->nullable();
            $table->text('benefits_details')->nullable();
            $table->text('condition_details')->nullable();
            $table->text('additional_details')->nullable();
            $table->date('application_deadline')->nullable();
            $table->date('employer_deadline')->nullable();
            $table->string('employment_permit_file')->nullable();
            $table->string('demand_latter_file')->nullable();
            $table->string('work_agreement_file')->nullable();
            $table->string('other_file')->nullable();
            $table->integer('status')->default(0)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_management');
    }
};
