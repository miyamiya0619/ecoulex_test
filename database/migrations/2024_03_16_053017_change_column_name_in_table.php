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
        Schema::table('companies', function (Blueprint $table) {
            $table->renameColumn('mail1', 'email');
            $table->renameColumn('mail2', 'email2');
            $table->renameColumn('mail3', 'email3');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->renameColumn('email', 'mail1');
            $table->renameColumn('email2', 'mail2');
            $table->renameColumn('email3', 'mail3');
        });
    }
};
