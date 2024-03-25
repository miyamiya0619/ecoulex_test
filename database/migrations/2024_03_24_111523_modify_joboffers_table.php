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
        Schema::table('joboffers', function (Blueprint $table) {
            $table->string('prefecuture_catch_head')->nullable()->change(); 
            $table->string('prefecuture_catch_reading')->nullable()->change(); 
            $table->string('prefecuture_image')->nullable()->change(); 
            $table->string('address_num')->nullable()->change(); 
            $table->string('addressDetail')->nullable()->change(); 
            $table->string('working_hours')->nullable()->change(); 
            $table->string('monthly_income')->nullable()->change(); 
            $table->string('offer1_by_form')->nullable()->change(); 
            $table->string('offer2_by_tel')->nullable()->change(); 
            $table->string('offer2_by_form')->nullable()->change(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
