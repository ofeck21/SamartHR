<?php

namespace Database\Seeders;

use App\Models\Bpjs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BPJSTableSeeder extends Seeder
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
                'name'      => 'Jaminan Hari Tua',
                'code'      => 'JHT',
                'employee'  => '2',
                'company'   => '3.7',
                'total'     => '5.7'
            ],
            [
                'name'      => 'Jaminan Kecelakaan Kerja',
                'code'      => 'JKK',
                'employee'  => '0',
                'company'   => '0.89',
                'total'     => '0.89'
            ],
            [
                'name'      => 'Jaminan Kematian',
                'code'      => 'JKM',
                'employee'  => '0',
                'company'   => '0.3',
                'total'     => '0.3'
            ],
            [
                'name'      => 'Jaminan Pensiun',
                'code'      => 'JP',
                'employee'  => '1',
                'company'   => '2',
                'total'     => '3'
            ],
            [
                'name'      => 'Jaminan Kesehatan',
                'code'      => 'JKS',
                'employee'  => '1',
                'company'   => '4',
                'total'     => '5'
            ],
            [
                'name'      => 'Asuransi Kecelakaan Diluar Hari Kerja',
                'code'      => 'AKDHK',
                'employee'  => '0',
                'company'   => '0.24',
                'total'     => '0.24'
            ],
        ];

        foreach ($data as $bpjs) {
            Bpjs::updateOrCreate(['code' => $bpjs['code']],$bpjs);
        }
    }
}
