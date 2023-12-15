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
        Schema::create('candidate_passport_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recruiting_agencies_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->string('passport_no')->nullable();
            $table->string('nid_no')->nullable();
            $table->string('full_name')->nullable();
            $table->string('fathers_name')->nullable();
            $table->string('mothers_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('passport_image')->nullable();
            $table->integer('gender')->nullable()->comment('1=male,2=female,3=other');
            $table->date('dob')->nullable();
            $table->date('passport_issue_date')->nullable();
            $table->date('passport_expiry_date')->nullable();
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
        Schema::dropIfExists('candidate_passport_infos');
    }
};
