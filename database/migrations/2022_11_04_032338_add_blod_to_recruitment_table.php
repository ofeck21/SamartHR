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
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');

            $table->string('religion');
            $table->string('tribes');
            $table->string('citizenship');
            $table->string('blood_group');
            $table->string('height');
            $table->string('width');
            $table->string('glasses');
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
