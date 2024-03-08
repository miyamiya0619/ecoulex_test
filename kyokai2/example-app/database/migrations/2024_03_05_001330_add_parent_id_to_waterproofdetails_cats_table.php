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
        Schema::table('waterproofdetails_cats', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('waterproofcat_parentid')->nullable();
            $table->foreign('waterproofcat_parentid')->references('waterproofcat_id')->on('waterproofdetails_cats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('waterproofdetails_cats', function (Blueprint $table) {
            //
            $table->dropForeign(['waterproofcat_parentid']);
            $table->dropColumn('waterproofcat_parentid');
        });
    }
};
