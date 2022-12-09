<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function PHPSTORM_META\map;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = [
            [
                'name'  => 'Dashboard',
                'url'   => '/',
                'icon'  => 'home',
                'slug'  => 'dashboard',
            ],
            [
                'name'  => 'Application',
                'slug'  => 'application',
                'header'=> true,
            ],
            [
                'name'  => 'Company',
                'url'   => '/companies',
                'icon'  => 'command',
                'slug'  => 'company',
                'features'  => '["view","create","update","delete"]'
            ],
            [
                'name'  => 'Recruitment',
                'url'   => '/recruitments',
                'icon'  => 'users',
                'slug'  => 'recruitments',
                'features'  => '["view","create","update","delete","import","export"]'
            ],
            [
                'name'  => 'Employee',
                'url'   => '/employee',
                'icon'  => 'users',
                'slug'  => 'employee',
                'features'  => '["view","create","update","delete","import","export"]'
            ],
            [
                'name'  => 'Attendance',
                'url'   => '/attendance',
                'icon'  => 'check-circle',
                'slug'  => 'attendance',
                'features'  => '["view","create","update","delete","import","export"]'
            ],
            [
                'name'  => 'Payroll',
                'url'   => '/payroll',
                'icon'  => 'credit-card',
                'slug'  => 'payroll',
                'features'  => '["view","create","update","delete","export"]',
            ],
            [
                'name'  => 'Report',
                'slug'  => 'report',
                'header'=> true,
            ],
            [
                'name'  => 'Payment',
                'url'   => '/payment',
                'icon'  => 'dollar-sign',
                'slug'  => 'payment',
                'features'  => '["view","update","export"]',
            ],
            [
                'name'  => 'Master Data',
                'slug'  => 'master_data',
                'header'=> true,
            ],
            [
                'name'  => 'Department',
                'url'   => '/department',
                'icon'  => 'layers',
                'slug'  => 'department',
                'features'  => '["view","create","update","delete"]'
            ],
            [
                'name'  => 'Job Position',
                'url'   => '/job-position',
                'icon'  => 'target',
                'slug'  => 'job_position',
                'features'  => '["view","create","update","delete"]'
            ],
            [
                'name'  => 'Job Level',
                'url'   => '/job-level',
                'icon'  => 'disc',
                'slug'  => 'job_level',
                'features'  => '["view","create","update","delete"]'
            ],
            [
                'name'  => 'Shift',
                'url'   => '/shift',
                'icon'  => 'crosshair',
                'slug'  => 'shift',
                'features'  => '["view","create","update","delete"]'
            ],
            [
                'name'  => 'Group',
                'url'   => '/group',
                'icon'  => 'life-buoy',
                'slug'  => 'group',
                'features'  => '["view","create","update","delete"]'
            ],
            [
                'name'  => 'Salary',
                'url'   => '/salaries',
                'icon'  => 'credit-card',
                'slug'  => 'salary',
                'features'  => '["view","create","update","delete"]'
            ],
            [
                'name'  => 'Salary Component',
                'url'   => '/salary-components',
                'icon'  => 'briefcase',
                'slug'  => 'salary_component',
                'features'  => '["view","create","update","delete"]'
            ],
            [
                'name'  => 'Settings',
                'slug'  => 'setting',
                'header'=> true
            ],
            [
                'name'  => 'User',
                'url'   => '/users',
                'icon'  => 'user',
                'slug'  => 'user',
                'features'  => '["view","create","update","delete"]'
            ],
            [
                'name'  => 'Role',
                'url'   => '/roles',
                'icon'  => 'shield',
                'slug'  => 'role',
                'features'  => '["view","create","update","delete"]'
            ],
            [
                'name'  => 'BPJS & PPH21',
                'url'   => '/bpjs-pph21',
                'icon'  => 'pen-tool',
                'slug'  => 'bpjs_pph21',
                'features'  => '["view","update"]'
            ],
            [
                'name'  => 'Language Settings',
                'url'   => '/languages',
                'icon'  => 'twitch',
                'slug'  => 'languages',
                'features'  => '["view","create","update","delete"]'
            ]
        ];

        $order = 1;
        foreach ($modules as $module) {
            $parent = Module::updateOrCreate(['name'  => $module['name']],[
                'name'  => $module['name'],
                'url'   => $module['url'] ?? null,
                'icon'  => $module['icon'] ?? null,
                'slug'  => $module['slug'] ?? null,
                'header'=> $module['header'] ?? false,
                'order' => $order,
                'features' => $module['features'] ?? '["view"]'
            ]);

            $order++;

            if(array_key_exists('child', $module)){
                $order_child = 1;
                foreach($module['child'] as $child){
                    Module::updateOrCreate(['name'  => $child['name']],[
                        'parent'=> $parent->id,
                        'name'  => $child['name'],
                        'url'   => $child['url'] ?? null,
                        'icon'  => $child['icon'] ?? null,
                        'slug'  => $child['slug'] ?? null,
                        'order' => $order_child,
                        'features' => $module['features'] ?? '["view"]'
                    ]);
                    $order_child++;
                }
            }
        }
    }
}
