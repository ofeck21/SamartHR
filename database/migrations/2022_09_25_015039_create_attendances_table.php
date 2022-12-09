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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('nik');
            $table->date('date')->nullable();
            $table->time('clock_in')->nullable();
            $table->time('clock_out')->nullable();
            $table->string('working_type')->nullable();
            $table->boolean('rill')->nullable();
            $table->time('late')->nullable();
            $table->time('early')->nullable();
            $table->time('overtime')->nullable();
            $table->time('working_hours')->nullable()->comment('jumlah jam kerja');
            $table->string('exception')->nullable();
            $table->string('symbol')->nullable();
            $table->boolean('normal_day')->nullable();
            $table->string('week')->nullable();
            $table->time('attendance_hours')->nullable()->comment('jumlah jam kerja ditambah lembur');
            $table->string('sum_worktime')->nullable();
            $table->string('sum_overtime')->nullable();
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
        Schema::dropIfExists('attendances');
    }
};
