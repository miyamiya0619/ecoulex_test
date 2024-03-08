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
        Schema::create('companiesdetails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->unique();
            $table->string('url')->nullable();
            $table->string('address_num')->nullable();
            $table->string('address')->nullable();
            $table->string('number_of_employees')->nullable();
            $table->string('year_of_establishment')->nullable();
            $table->string('capital')->nullable();
            $table->string('representative')->nullable();
            $table->string('phone')->nullable();
            $table->string('form')->nullable();
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
        Schema::dropIfExists('companiesdetails');
    }
};
