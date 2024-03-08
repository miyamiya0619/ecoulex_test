<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('joboffers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('prefecuture_catch_head');
            $table->string('prefecuture_catch_reading');
            $table->string('prefecuture_image');
            $table->string('locate');
            $table->string('working_hours');
            $table->string('monthly_income');
            $table->string('offer1_by_form');
            $table->string('offer2_by_tel');
            $table->string('offer2_by_form');
            $table->timestamps();
            
            $table->foreign('company_id')->references('company_id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('joboffers');
    }
};
