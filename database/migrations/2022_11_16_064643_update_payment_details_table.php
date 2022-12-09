<?php

use Doctrine\DBAL\Types\Type;
use Illuminate\Support\Facades\DB;
use Doctrine\DBAL\Types\StringType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function __construct()
    {
        if (! Type::hasType('enum')) {
            Type::addType('enum', StringType::class);
        }
        // For point types
        // DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('point', 'string');
        DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_details', function (Blueprint $table) {
            $table->enum('type', ['salary', 'allowance', 'reduction', 'bpjs', 'pph21'])->change();
            $table->text('nominal')->nullable()->change();
            $table->text('code')->nullable()->change();
            $table->text('nominal_company')->nullable();
            $table->text('nominal_employee')->nullable();
            $table->text('company_percentage')->nullable();
            $table->text('employee_percentage')->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
