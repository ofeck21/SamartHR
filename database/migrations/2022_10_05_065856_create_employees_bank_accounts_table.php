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
        Schema::create('employees_bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employees_id');
            $table->string('account_title');
            $table->string('account_number');
            $table->string('bank_name');
            $table->string('bank_code');
            $table->string('bank_branch');
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
        Schema::dropIfExists('employees_bank_accounts');
    }
};
