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
        Schema::create('employees_immigration', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employees_id');
            $table->bigInteger('document_type_id');
            $table->date('issue_date');
            $table->bigInteger('country_id');
            $table->string('document_number');
            $table->date('expired_date')->nullable();
            $table->date('review_date')->nullable();
            $table->string('document_file');
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
        Schema::dropIfExists('employees_immigration');
    }
};
