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
        Schema::table('employees_social_profiles', function (Blueprint $table) {
            $table->dropColumn('facebook');
            $table->dropColumn('skype');
            $table->dropColumn('linked_in');
            $table->dropColumn('twitter');
            $table->dropColumn('whatsapp');

            $table->string('social_name')->nullable();
            $table->string('social_id')->nullable();
            $table->string('social_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees_social_profiles', function (Blueprint $table) {
            //
        });
    }
};
