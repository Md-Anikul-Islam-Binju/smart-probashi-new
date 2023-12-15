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
        Schema::table('clearances', function (Blueprint $table) {
            $table->string('section_name')->nullable();
            $table->integer('section_approved_status')->default(0);
            $table->string('section_sign')->nullable();
            $table->date('section_date')->nullable();
            $table->string('translator_name')->nullable();
            $table->integer('translator_approved_status')->default(0);
            $table->string('translator_sign')->nullable();
            $table->date('translator_date')->nullable();
            $table->string('ad_name')->nullable();
            $table->integer('ad_approved_status')->default(0);
            $table->string('ad_sign')->nullable();
            $table->date('ad_date')->nullable();
            $table->string('dd_name')->nullable();
            $table->integer('dd_approved_status')->default(0);
            $table->string('dd_sign')->nullable();
            $table->date('dd_date')->nullable();
            $table->string('d_name')->nullable();
            $table->integer('d_approved_status')->default(0);
            $table->string('d_sign')->nullable();
            $table->date('d_date')->nullable();
            $table->string('adg_name')->nullable();
            $table->integer('adg_approved_status')->default(0);
            $table->string('adg_sign')->nullable();
            $table->date('adg_date')->nullable();
            $table->string('dg_name')->nullable();
            $table->integer('dg_approved_status')->default(0);
            $table->string('dg_sign')->nullable();
            $table->date('dg_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clearances', function (Blueprint $table) {
            //
        });
    }
};
