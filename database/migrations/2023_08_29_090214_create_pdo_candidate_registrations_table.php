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
        Schema::create('pdo_candidate_registrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('recruiting_agencies_id')->nullable();
            $table->unsignedBigInteger('passport_info_id')->nullable();
            $table->unsignedBigInteger('training_center_id')->nullable();
            $table->unsignedBigInteger('training_schedule_id')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->string('passport_no')->nullable();
            $table->string('full_name')->nullable();
            $table->string('fathers_name')->nullable();
            $table->string('mothers_name')->nullable();
            $table->date('dob')->nullable();
            $table->integer('gender')->nullable()->comment('1=male, 2=female, 3=other');
            $table->unsignedBigInteger('religion_id')->nullable();
            $table->string('nid_no')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->double('fees', 8, 2)->nullable();
            $table->integer('payment_status')->default(0)->comment('0 = Not-paid, 1 = Paid')->nullable();
            $table->string('transaction_id')->nullable();
            $table->double('transaction_amount', 8, 2)->nullable();
            $table->string('payment_through')->nullable();
            $table->string('photo')->nullable();
            $table->integer('approval_status')->default(0)->comment('0 = Not-approved, 1 = Approved')->nullable();
            $table->string('roll_no')->nullable();
            $table->string('candidate_user_id')->nullable();
            $table->string('certificate_no')->nullable();
            $table->integer('training_status')->default(0)->comment('0 = Not-trained, 1 = Trained')->nullable();
            $table->integer('certificate_status')->default(0)->comment('0 = Not-certified, 1 = Certified')->nullable();
            $table->integer('step_no')->default(0)->comment('0 = Root, 1 = Personal Information, 2 = Batch Information, 3 = Payment Information, 4 = Upload Photo, 5 = Enrollment Card,')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pdo_candidate_registrations');
    }
};
