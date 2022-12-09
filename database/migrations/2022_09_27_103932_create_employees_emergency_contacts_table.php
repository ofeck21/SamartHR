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
        Schema::create('employees_emergency_contacts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employees_id');
            $table->unsignedBigInteger('status_family_stucture_id');
            $table->string('name');
            $table->bigInteger('phone_number');
            $table->string('description')->nullable();
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
        Schema::dropIfExists('employees_emergency_contacts');
    }
};
