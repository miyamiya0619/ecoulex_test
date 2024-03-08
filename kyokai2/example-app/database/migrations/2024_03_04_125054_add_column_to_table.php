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
            //
            $table->string('offer1_by_tel')->nullable()->after('monthly_income');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('joboffers', function (Blueprint $table) {
            $table->dropColumn('offer1_by_tel');
        });
    }
};
