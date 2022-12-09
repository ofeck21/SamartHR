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
        Schema::create('recruitment', function (Blueprint $table) {
            $table->id();
            $table->string('photo');
            $table->string('fullname');
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->enum('gender', ['L','P']);
            $table->string('mobile_phone_number')->unique();
            $table->string('phone_number')->nullable();
            $table->string('email')->unique();
            $table->string('id_card_address');
            $table->string('residence_address');
            $table->enum('marital_status', ['single', 'married', 'widower', 'widow']);
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
        Schema::dropIfExists('recruitment');
    }
};
