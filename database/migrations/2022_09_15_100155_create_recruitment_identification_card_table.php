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
        Schema::create('recruitment_identification_card', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('recruitment_id');
            $table->string('identity_card');
            $table->bigInteger('identity_card_number_card');
            $table->bigInteger('validity_period_card');
            $table->string('drivers_license');
            $table->bigInteger('identity_card_number_drivers');
            $table->bigInteger('validity_period_drivers');
            $table->string('religion');
            $table->string('tribes');
            $table->string('citizenship');
            $table->enum('blood_group',['A','B','AB','O']);
            $table->string('height');
            $table->string('width');
            $table->enum('glasses', ['n','y']);
            $table->text('question1')->nullable();
            $table->text('question2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recruitment_identification_card');
    }
};
