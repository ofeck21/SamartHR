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
            $table->dropColumn('identity_card_number_drivers');
            $table->dropColumn('validity_period_drivers');
            $table->dropColumn('drivers_license');
            $table->dropColumn('religion');
            $table->dropColumn('tribes');
            $table->dropColumn('citizenship');
            $table->dropColumn('blood_group');
            $table->dropColumn('height');
            $table->dropColumn('width');
            $table->dropColumn('glasses');
            
            $table->string('card_number');
            $table->string('validity_period');
            $table->enum('is_drivers_license', ['0','1']);
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
