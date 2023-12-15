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
        Schema::table('job_management', function (Blueprint $table) {
            $table->string('employer_address')->nullable();
            $table->string('working_duration')->nullable();
            $table->string('working_days')->nullable();
            $table->string('working_on')->nullable();
            $table->integer('is_one_way')->default(0)->nullable();
            $table->integer('is_two_way')->default(0)->nullable();
            $table->integer('is_other')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_management', function (Blueprint $table) {
            $table->dropColumn('employer_address');
            $table->dropColumn('working_duration');
            $table->dropColumn('working_days');
            $table->dropColumn('working_on');
            $table->dropColumn('is_one_way');
            $table->dropColumn('is_two_way');
            $table->dropColumn('is_other');
        });
    }
};
