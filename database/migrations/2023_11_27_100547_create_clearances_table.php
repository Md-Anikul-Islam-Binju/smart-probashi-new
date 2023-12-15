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
        Schema::create('clearances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->string('application_no')->nullable();
            $table->string('clearance_type')->nullable();
            $table->integer('recruiting_agency_id')->nullable();
            $table->string('foreign_ref_no')->nullable();
            $table->date('foreign_ref_date')->nullable();
            $table->string('ministry_ref_no')->nullable();
            $table->date('ministry_ref_date')->nullable();
            $table->string('bmet_reference_no')->nullable();
            $table->date('bmet_reference_date')->nullable();
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
        Schema::dropIfExists('clearances');
    }
};
