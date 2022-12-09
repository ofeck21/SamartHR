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
        Schema::create('recruitment_leisure_activities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('recruitment_id');
            $table->string('leisure_activities');
            $table->string('active');
            $table->string('passive');
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
        Schema::dropIfExists('recruitment_leisure_activities');
    }
};