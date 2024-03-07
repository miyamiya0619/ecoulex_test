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
        Schema::create('waterproofs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('waterproofing_job_description');
            $table->string('waterproofing_job_catch');
            $table->string('waterproofing_job_image');
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
        Schema::dropIfExists('waterproofs');
    }
};
