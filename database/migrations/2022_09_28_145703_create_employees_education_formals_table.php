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
        Schema::create('employees_education_profiles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employees_id');
            $table->enum('school_type', ['formal', 'informal'])->nullable('formal');
            $table->bigInteger('school_level')->nullable();
            $table->string('school_name');
            $table->string('city');
            $table->integer('start');
            $table->integer('finish');
            $table->enum('graduated', ['y','n']);
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
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
        Schema::dropIfExists('employees_education_profiles');
    }
};
