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
        Schema::create('recruitment_formal_education', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('recruitment_id');
            $table->enum('school_level', ['SD', 'SLTP', 'SLTA', 'S1']);
            $table->string('school_name');
            $table->string('city');
            $table->integer('start');
            $table->integer('finish');
            $table->enum('graduated', ['y','n']);
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
        Schema::dropIfExists('recruitment_formal_education');
    }
};
