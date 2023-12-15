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
        Schema::create('visa_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('passport_info_id')->nullable();
            $table->string('visa_no')->nullable();
            $table->string('sticker_no')->nullable();
            $table->string('visa_reference_no')->nullable();
            $table->date('visa_issue_date')->nullable();
            $table->date('visa_expiry_date')->nullable();
            $table->integer('sponsor_id')->nullable();
            $table->string('attestation_ref_no')->nullable();
            $table->date('attestation_ref_date')->nullable();
            $table->string('visa_file')->nullable();
            $table->string('employment_contract_file')->nullable();
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
        Schema::dropIfExists('visa_infos');
    }
};
