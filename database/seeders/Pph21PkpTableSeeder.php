<?php

namespace Database\Seeders;

use App\Models\Pph21Pkp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Pph21PkpTableSeeder extends Seeder
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
                'id'    => 1,
                'from'  => 0,
                'until' => 50000000,
                'rate'  => 5,
                'description'   => 'PKP sampai dengan 50 juta rupiah'
            ],
            [
                'id'    => 2,
                'from'  => 50000001,
                'until' => 250000000,
                'rate'  => 15,
                'description'   => 'PKP 50 sampai dengan 250 juta rupiah'
            ],
            [
                'id'    => 3,
                'from'  => 250000001,
                'until' => 500000000,
                'rate'  => 25,
                'description'   => 'PKP 250 sampai dengan 500 juta rupiah '
            ],
            [
                'id'    => 4,
                'from'  => 500000001,
                'until' => 0,
                'rate'  => 30,
                'description'   => 'PKP diatas 500 juta rupiah'
            ]
        ];

        foreach ($data as $value) {
            Pph21Pkp::updateOrCreate(['id' => $value['id']],$value);
        }
    }
}
