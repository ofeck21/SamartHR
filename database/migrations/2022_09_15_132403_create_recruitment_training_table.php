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
        Schema::create('recruitment_training', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('recruitment_id');
            $table->string('field');
            $table->string('organizer');
            $table->string('city');
            $table->integer('times');
            $table->string('funded_by');
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
        Schema::dropIfExists('recruitment_training');
    }
};
