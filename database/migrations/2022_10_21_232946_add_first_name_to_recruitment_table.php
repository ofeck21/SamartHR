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
        Schema::table('recruitment', function (Blueprint $table) {
            // $table->dropColumn('fullame');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();

            $table->string('nik')->nullable();
            $table->string('file_nik')->nullable();
            $table->string('no_kk')->nullable();
            $table->string('file_no_kk')->nullable();
            $table->string('no_skck')->nullable();
            $table->string('file_no_skck')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recruitment', function (Blueprint $table) {
            //
        });
    }
};
