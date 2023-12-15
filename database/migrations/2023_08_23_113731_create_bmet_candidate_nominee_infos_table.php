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
        Schema::create('bmet_candidate_nominee_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('passport_info_id')->nullable();
            $table->unsignedBigInteger('nominee_relation_id')->nullable();
            $table->unsignedBigInteger('nominee_district_id')->nullable();
            $table->unsignedBigInteger('nominee_upazilla_id')->nullable();
            $table->string('nominee_name')->nullable();
            $table->string('nominee_nid')->nullable();
            $table->string('nominee_phone')->nullable();
            $table->string('nominee_fathers_name')->nullable();
            $table->string('nominee_mothers_name')->nullable();
            $table->string('nominee_union')->nullable();
            $table->string('nominee_village')->nullable();
            $table->string('nominee_house')->nullable();
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
        Schema::dropIfExists('bmet_candidate_nominee_infos');
    }
};
