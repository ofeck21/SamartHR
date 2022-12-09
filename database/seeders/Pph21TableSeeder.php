<?php

namespace Database\Seeders;

use App\Models\Pph21;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Pph21TableSeeder extends Seeder
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
                'golongan'      => 'Tidak Kawin',
                'code'          => 'TK-0',
                'ptkp'          => '54000000',
                'description'   => 'Tidak Kawin, Tanpa Tanggungan'
            ],
            [
                'golongan'      => 'Tidak Kawin',
                'code'          => 'TK-1',
                'ptkp'          => '58500000',
                'description'   => 'Tidak Kawin, 1 Tanggungan'
            ],
            [
                'golongan'      => 'Tidak Kawin',
                'code'          => 'TK-2',
                'ptkp'          => '63000000',
                'description'   => 'Tidak Kawin, 2 Tanggungan'
            ],
            [
                'golongan'      => 'Tidak Kawin',
                'code'          => 'TK-3',
                'ptkp'          => '67500000',
                'description'   => 'Tidak Kawin, 3 Tanggungan'
            ],
            [
                'golongan'      => 'Kawin',
                'code'          => 'K-0',
                'ptkp'          => '58500000',
                'description'   => 'Kawin, Tanpa Tanggungan'
            ],
            [
                'golongan'      => 'Kawin',
                'code'          => 'K-1',
                'ptkp'          => '63000000',
                'description'   => 'Kawin, 1 Tanggungan'
            ],
            [
                'golongan'      => 'Kawin',
                'code'          => 'K-2',
                'ptkp'          => '67500000',
                'description'   => 'Kawin, 2 Tanggungan'
            ],
            [
                'golongan'      => 'Kawin',
                'code'          => 'K-3',
                'ptkp'          => '72000000',
                'description'   => 'Kawin, 3 Tanggungan'
            ],
            [
                'golongan'      => 'Kawin + Istri',
                'code'          => 'KI-0',
                'ptkp'          => '112500000',
                'description'   => 'Penghasilan Suami dan Istri Digabung, Tanpa Tanggungan'
            ],
            [
                'golongan'      => 'Kawin + Istri',
                'code'          => 'KI-1',
                'ptkp'          => '117000000',
                'description'   => 'Penghasilan Suami dan Istri Digabung, 1 Tanggungan'
            ],
            [
                'golongan'      => 'Kawin + Istri',
                'code'          => 'KI-2',
                'ptkp'          => '121500000',
                'description'   => 'Penghasilan Suami dan Istri Digabung, 2 Tanggungan'
            ],
            [
                'golongan'      => 'Kawin + Istri',
                'code'          => 'KI-3',
                'ptkp'          => '126000000',
                'description'   => 'Penghasilan Suami dan Istri Digabung, 3 Tanggungan'
            ],
        ];

        foreach ($data as $pph21) {
            Pph21::updateOrCreate(['code' => $pph21['code']],$pph21);
        }
    }
}
