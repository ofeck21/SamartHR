<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(OptiontableSeeder::class);
        $this->call(ModuleTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(RolePermissionTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(LocalLangSeeder::class);
        $this->call(EmployeesStatusSeeder::class);
        $this->call(EmployeesCategorySeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(LangSeeder::class);
    }
}
