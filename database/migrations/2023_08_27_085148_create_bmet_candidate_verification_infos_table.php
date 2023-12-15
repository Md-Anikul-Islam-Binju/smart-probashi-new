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
        Schema::create('bmet_candidate_verification_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('passport_info_id')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->integer('payment_status')->default(0)->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('transaction_amount')->nullable();
            $table->string('payment_through')->nullable();
            $table->integer('candidate_verify_status')->default(0)->nullable();
            $table->integer('registration_status')->default(0)->nullable();
            $table->SoftDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bmet_candidate_verification_infos');
    }
};
