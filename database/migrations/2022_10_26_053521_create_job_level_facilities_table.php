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
        Schema::create('job_level_facilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_level_id');
            $table->foreign('job_level_id')->references('id')->on('job_levels')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('salary_component_id')->nullable();
            $table->foreign('salary_component_id')->references('id')->on('salary_components');
            $table->unsignedBigInteger('salary_id')->nullable();
            $table->foreign('salary_id')->references('id')->on('salaries');
            $table->enum('type', ['salary', 'allowance'])->default('allowance');
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
        Schema::dropIfExists('job_level_facilities');
    }
};
