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
        Schema::create('employees_on_leave', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employees_id');
            $table->year('year');
            $table->text('Leave_reason');	
            $table->text('note');
            $table->enum('status', ['s','y','n'])->default('s');	
            $table->date('start_date');
            $table->date('end_date');
            $table->dateTime('applied_date');
            $table->bigInteger('total_days');
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
        Schema::dropIfExists('employees_on_leave');
    }
};
