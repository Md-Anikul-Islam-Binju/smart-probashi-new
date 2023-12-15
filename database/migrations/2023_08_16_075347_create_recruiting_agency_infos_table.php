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
        Schema::create('recruiting_agency_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->bigInteger('organization_id')->unsigned()->nullable();
            $table->bigInteger('currency_id')->unsigned()->nullable();
            $table->integer('recruiting_agency_portal_access')->comment('1=Bangladeshi Recruiting Agency, 2=Foreign Recruiting Agency')->nullable();
            $table->string('designation')->nullable();
            $table->string('trade_license')->nullable();
            $table->string('recruiting_license')->nullable();
            $table->string('business_card')->nullable();
            $table->integer('gender')->comment('1=Male, 2=Female, 3=Other')->nullable();
            $table->string('foreign_organization_name')->nullable();
            $table->string('foreign_organization_address')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recruiting_agency_infos');
    }
};
