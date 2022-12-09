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
        Schema::create('employee_salary_components', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('salary_component_id');
            $table->foreign('salary_component_id')->references('id')->on('salary_components')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees')->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('month')->nullable();
            $table->string('name')->nullable();
            $table->string('nominal')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
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
        Schema::dropIfExists('employee_salary_components');
    }
};
