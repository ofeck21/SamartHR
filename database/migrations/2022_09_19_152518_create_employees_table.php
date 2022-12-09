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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->bigInteger('users_id')->unique();
            $table->string('employee_id', 50)->unique();
            $table->string('id_card', 50)->unique();
            $table->string('national_number', 50)->unique();
            $table->string('employee_id_number', 50)->unique();
            $table->string('mobile_phone', 13)->nullable();
            $table->string('phone', 10)->nullable(); 
            $table->text('original_address')->nullable();
            $table->text('current_address')->nullable();
            $table->bigInteger('country_id')->nullable();
            $table->string('province', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->bigInteger('zip_code')->nullable();

            $table->date('date_of_birth');
            $table->bigInteger('gender_id');
            $table->bigInteger('marital_status_id')->nullable();
            $table->bigInteger('religion_id')->nullable();
            
            $table->bigInteger('job_levels');
            $table->bigInteger('job_position_id');
            $table->bigInteger('department_id');
            $table->bigInteger('company_id');
            
            
            $table->string('work_place')->nullable();
            $table->bigInteger('employee_status_id')->nullable();
            $table->bigInteger('employee_category_id')->nullable();
            $table->date('date_of_joining')->nullable();
            $table->date('date_of_leaving')->nullable();
            
            $table->bigInteger('blood_group_id')->nullable();
            $table->string('tribes')->nullable();
            
            $table->string('photo')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('employees');
    }
};
