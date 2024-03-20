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
            $table->renameColumn('locate', 'address_num');

            // 新しいカラムを追加する
            $table->string('prefectureName')->after('locate')->nullable();
            $table->string('addressDetail')->after('prefectureName')->nullable();
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
            $table->renameColumn('address_num', 'locate');

            // 新しいカラムを削除する
            $table->dropColumn('prefectureName');
            $table->dropColumn('addressDetail');
        });
    }
};
