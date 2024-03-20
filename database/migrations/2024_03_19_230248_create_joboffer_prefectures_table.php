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
        Schema::create('joboffer_prefectures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_id')->unique();
            $table->unsignedBigInteger('prefecuture_id')->nullable();

            $table->foreign('job_id')->references('company_id')->on('joboffers');
            $table->foreign('prefecuture_id')->references('prefecuture_id')->on('prefectures_cats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('joboffer_prefectures');
    }
};
