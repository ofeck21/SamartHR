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
        Schema::create('recruitment_family_structure', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('recruitment_id');
            $table->enum('structure', ['father', 'mother', 'sibling', 'child']);
            $table->string('name');
            $table->enum('gender', ['L','P']);
            $table->integer('age');
            $table->string('education')->nullable();
            $table->string('position')->nullable();
            $table->string('company')->nullable();
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
        Schema::dropIfExists('recruitment_family_structure');
    }
};
