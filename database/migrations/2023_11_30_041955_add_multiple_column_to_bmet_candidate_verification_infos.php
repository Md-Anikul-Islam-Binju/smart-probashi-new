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
        Schema::table('bmet_candidate_verification_infos', function (Blueprint $table) {
            $table->string('bmet_verification_registration_no')->nullable();
            $table->integer('biometric_status')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bmet_candidate_verification_infos', function (Blueprint $table) {
            $table->dropColumn('bmet_verification_registration_no');
            $table->dropColumn('biometric_status');
        });
    }
};
