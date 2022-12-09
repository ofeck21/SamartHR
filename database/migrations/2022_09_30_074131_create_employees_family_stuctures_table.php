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
        Schema::create('employees_family_structures', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employees_id');
            $table->bigInteger('structure');
            $table->enum('is_bpjs', [0,1]);
            $table->string('name');
            $table->bigInteger('gender');
            $table->integer('age')->nullable();
            $table->string('education')->nullable();
            $table->string('position')->nullable();
            $table->string('company')->nullable();
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
        Schema::dropIfExists('employees_family_structures');
    }
};
