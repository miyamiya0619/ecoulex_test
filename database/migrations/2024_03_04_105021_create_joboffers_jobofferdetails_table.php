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
        Schema::create('joboffers_jobofferdetails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jobcat_id')->nullable();
            $table->unsignedBigInteger('joboffer_id')->nullable();

            $table->foreign('jobcat_id')->references('jobcat_id')->on('jobofferdetail_cats');
            $table->foreign('joboffer_id')->references('id')->on('joboffers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('joboffers_jobofferdetails');
    }
};
