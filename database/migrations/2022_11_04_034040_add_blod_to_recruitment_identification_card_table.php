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
        Schema::table('recruitment_identification_card', function (Blueprint $table) {
            $table->enum('type', ['A','B','C', 'PASSPORT', 'BPJS NAKER', 'BPJS KESEHATAN', 'NPWP']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recruitment_identification_card', function (Blueprint $table) {
            //
        });
    }
};
