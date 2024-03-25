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
        Schema::table('companieshistories', function (Blueprint $table) {
            //
            $table->dropForeign(['company_id']);
            // 一意制約を削除
            $table->dropUnique('companieshistories_company_id_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companieshistories', function (Blueprint $table) {
            $table->unique('company_id');
            // 外部キー制約を再度追加
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }
};
