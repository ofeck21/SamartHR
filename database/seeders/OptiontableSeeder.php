<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptiontableSeeder extends Seeder
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
                'group' => 'company_type',
                'child' => [
                    [
                        'name'=> 'Induk Perusahaan'
                    ],
                    [
                        'name'=> 'Entity Anak Langsung'
                    ],
                    [
                        'name'=> 'Entity Anak Tidak Langsung'
                    ]
                ]
            ],
            [
                'group' => 'religion',
                'child' => [
                    [
                        'name'=> 'Islam'
                    ],
                    [
                        'name'=> 'Kristen'
                    ],
                    [
                        'name'=> 'Hindu'
                    ],
                    [
                        'name'=> 'Budha'
                    ],
                    [
                        'name'=> 'Katolik'
                    ]
                ]
            ],
            [
                'group' => 'maratial_status',
                'child' => [
                    [
                        'name'=> 'Kawin'
                    ],
                    [
                        'name'=> 'Belum Kawin'
                    ],
                    [
                        'name'=> 'Cerai Hidup'
                    ],
                    [
                        'name'=> 'Cerai Mati'
                    ]
                ]
            ],
            [
                'group' => 'blood_group',
                'child' => [
                    [
                        'name'=> 'A'
                    ],
                    [
                        'name'=> 'B'
                    ],
                    [
                        'name'=> 'O'
                    ],
                    [
                        'name'=> 'AB'
                    ]
                ]
            ],
            [
                'group' => 'gender',
                'child' => [
                    [
                        'name'=> 'male'
                    ],
                    [
                        'name'=> 'female'
                    ]
                ]
            ],
            [
                'group' => 'document_type',
                'child' => [
                    [
                        'name' => 'Driving Licesnse'
                    ],
                    [
                        'name' => 'Passport'
                    ],
                    [
                        'name' => 'National Id'
                    ]
                ]
            ],
            [
                'group' => 'family_structure',
                'child' => [
                    [
                        'name' => 'Ayah'
                    ],
                    [
                        'name' => 'Ibu'
                    ],
                    [
                        'name' => 'Suami'
                    ],
                    [
                        'name' => 'Istri'
                    ],
                    [
                        'name' => 'Anak'
                    ],
                    [
                        'name' => 'Saudara'
                    ]
                ]
            ],
            [
                'group' => 'school_level',
                'child' => [
                    [
                        'name' => 'PAUD'
                    ],
                    [
                        'name' => 'TK'
                    ],
                    [
                        'name' => 'SD'
                    ],
                    [
                        'name' => 'SMP'
                    ],
                    [
                        'name' => 'SMA'
                    ],
                    [
                        'name' => 'S1'
                    ],
                    [
                        'name' => 'S2'
                    ],
                    [
                        'name' => 'S3'
                    ]
                ]
            ],
            [
                'group' => 'month',
                'child' => [
                    [
                        'name' => 'Januari'
                    ],
                    [
                        'name' => 'Februari'
                    ],
                    [
                        'name' => 'Maret'
                    ],
                    [
                        'name' => 'April'
                    ],
                    [
                        'name' => 'Mei'
                    ],
                    [
                        'name' => 'Juni'
                    ],
                    [
                        'name' => 'Juli'
                    ],
                    [
                        'name' => 'Agustus'
                    ],
                    [
                        'name' => 'September'
                    ],
                    [
                        'name' => 'Oktober'
                    ],
                    [
                        'name' => 'November'
                    ],
                    [
                        'name' => 'Desember'
                    ]
                ]
            ],
            [
                'group' => 'employee_status',
                'child' => [
                    [
                        'name' => 'Aktif'
                    ],
                    [
                        'name' => 'Karyawan Pensiun'
                    ],
                    [
                        'name' => 'Keluar'
                    ], 
                    [
                        'name' => 'Tidak Ada Akses'
                    ], 
                ]
            ],
            [
                'group' => 'employment_status',
                'child' => [
                    [
                        'name' => 'KONTRAK'
                    ],
                    [
                        'name' => 'TETAP'
                    ]
                ]
            ],

        ];

        foreach ($data as $option) {
            foreach ($option['child'] as $value) {
                Option::firstOrCreate([
                    'group' => $option['group'],
                    'name'  => $value['name']
                ]);
            }
        }
    }
}
