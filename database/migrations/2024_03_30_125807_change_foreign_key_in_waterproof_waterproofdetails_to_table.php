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
        Schema::table('waterproof_waterproofdetails', function (Blueprint $table) {
            $table->dropForeign('waterproof_waterproofdetails_waterproof_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('waterproof_waterproofdetails', function (Blueprint $table) {
            //
        });
    }
};
