<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::table('recruitment_family_structure', function (Blueprint $table) {
            DB::statement("ALTER TABLE recruitment_family_structure MODIFY COLUMN structure ENUM('father', 'mother', 'sibling', 'child', 'husband', 'wife')");

            // $table->enum('structure', ['father', 'mother', 'sibling', 'child', 'husband', 'wife'])->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recruitment_family_structure', function (Blueprint $table) {
            //
        });
    }
};
