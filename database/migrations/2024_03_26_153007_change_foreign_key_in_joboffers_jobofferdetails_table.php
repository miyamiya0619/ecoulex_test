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
        Schema::table('joboffers_jobofferdetails', function (Blueprint $table) {
            $table->dropForeign(['joboffer_id']); // 既存の外部キー制約を削除
            $table->foreign('joboffer_id')->references('company_id')->on('joboffers'); // 新しい外部キー制約を追加
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('joboffers_jobofferdetails', function (Blueprint $table) {
            $table->dropForeign(['joboffer_id']); // 新しい外部キー制約を削除
            $table->foreign('joboffer_id')->references('id')->on('joboffers'); // 元の外部キー制約を再追加
        });
    }
};
