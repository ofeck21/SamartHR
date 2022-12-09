<?php

namespace Database\Seeders;

use App\Models\EmployeesCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeesCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'              => 'Kategori 1',
                'description'       => '',
                'created_by'        => '1',
                'updated_by'        => '1',
            ],
            [
                'name'              => 'Kategory 2',
                'description'       => '',
                'created_by'        => '1',
                'updated_by'        => '1',
            ]
        ];

        foreach ($data as $key => $value) {
            EmployeesCategory::firstOrCreate($value);
        }
    }
}
