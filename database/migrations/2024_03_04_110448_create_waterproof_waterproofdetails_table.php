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
        Schema::create('waterproof_waterproofdetails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('waterproof_id')->nullable();
            $table->unsignedBigInteger('waterproofcat_id')->nullable();

            $table->foreign('waterproof_id')->references('id')->on('waterproofs');
            $table->foreign('waterproofcat_id')->references('waterproofcat_id')->on('waterproofdetails_cats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('waterproof_waterproofdetails');
    }
};
