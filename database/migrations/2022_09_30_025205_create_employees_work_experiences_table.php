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
        Schema::create('employees_work_experiences', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employees_id');
            $table->string('start_month');
            $table->string('start_year');
            $table->string('start_salary');
            $table->string('start_subsidy');
            $table->string('start_position');

            $table->string('finish_month');
            $table->string('finish_year');
            $table->string('finish_salary');
            $table->string('finish_subsidy');
            $table->string('finish_position');

            $table->text('company_name_and_address');
            $table->string('type_of_business');

            $table->text('reason_to_stop');
            $table->text('brief_overview');
            $table->text('position_struktur_organisasi');
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
        Schema::dropIfExists('employees_work_experiences');
    }
};
