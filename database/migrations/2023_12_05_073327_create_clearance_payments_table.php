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
        Schema::create('clearance_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clearance_id')->nullable();
            $table->string('payment_type');
            $table->string('advance_tax');
            $table->string('service_charge');
            $table->string('insurance_fee');
            $table->string('payment_status');
            $table->string('total_candidate_payment');
            $table->string('total_payment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clearance_payments');
    }
};
