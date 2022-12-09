<?php

namespace Database\Seeders;

use App\Models\EmployeesStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeesStatusSeeder extends Seeder
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
                'name'              => 'full-time',
                'description'       => '',
                'created_by'        => '1',
                'updated_by'        => '1',
            ],
            [
                'name'              => 'part-time',
                'description'       => '',
                'created_by'        => '1',
                'updated_by'        => '1',
            ],
            [
                'name'              => 'internship',
                'description'       => '',
                'created_by'        => '1',
                'updated_by'        => '1',
            ],
            [
                'name'              => 'terminated',
                'description'       => '',
                'created_by'        => '1',
                'updated_by'        => '1',
            ],
        ];
        EmployeesStatus::where('id', '>', '0')->delete();

        foreach ($data as $key => $value) {
            EmployeesStatus::firstOrCreate($value);
        }
    }
}
