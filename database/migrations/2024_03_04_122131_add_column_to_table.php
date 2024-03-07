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
        Schema::table('prefectures_cats', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('region_id')->nullable();
            $table->string('regionName')->nullable();
        });

        Schema::table('joboffers', function (Blueprint $table) {
            //
            $table->string('joboffers')->nullable()->after('monthly_income');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prefectures_cats', function (Blueprint $table) {
            //
            $table->dropColumn('region_id');
            $table->dropColumn('regionName');
        });

        Schema::table('joboffers', function (Blueprint $table) {
            //
            $table->dropColumn('joboffers');
        });
    }
};
