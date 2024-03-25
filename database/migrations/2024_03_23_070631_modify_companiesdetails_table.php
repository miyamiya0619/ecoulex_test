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
        Schema::table('companiesdetails', function (Blueprint $table) {
            $table->string('prefectureName')->nullable(false)->change(); 
            $table->string('addressDetail')->nullable(false)->change(); 
            $table->string('representative')->nullable(false)->change(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companiesdetails', function (Blueprint $table) {
            $table->string('prefectureName')->nullable()->change(); 
            $table->string('addressDetail')->nullable()->change(); 
            $table->string('representative')->nullable()->change(); 
        });
    }
};
