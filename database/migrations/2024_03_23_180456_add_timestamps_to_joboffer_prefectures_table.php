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
        Schema::table('joboffer_prefectures', function (Blueprint $table) {
            $table->timestamps(); // これを追加
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('joboffer_prefectures', function (Blueprint $table) {
            $table->dropTimestamps(); // ロールバック時にカラムを削除する
        });
    }
};
