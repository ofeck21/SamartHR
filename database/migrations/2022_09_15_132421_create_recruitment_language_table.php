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
        Schema::create('recruitment_language', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('recruitment_id');
            $table->string('language');
            $table->enum('hear', ['baik sekali', 'baik', 'cukup']);
            $table->enum('read', ['baik sekali', 'baik', 'cukup']);
            $table->enum('write', ['baik sekali', 'baik', 'cukup']);
            $table->enum('speak', ['baik sekali', 'baik', 'cukup']);
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
        Schema::dropIfExists('recruitment_language');
    }
};
