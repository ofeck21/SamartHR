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
            $table->dropColumn('identity_card');
            $table->dropColumn('identity_card_number_card');
            $table->dropColumn('validity_period_card');

            $table->dropColumn('question1');
            $table->dropColumn('question2');


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
