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
        Schema::create('employees_all_documents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employees_id');

            $table->bigInteger('document_type_id');
            $table->string('document_title');
            $table->date('expiry_date')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('employees_all_documents');
    }
};
