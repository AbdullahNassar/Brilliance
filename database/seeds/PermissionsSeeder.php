<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'sales',
                'guard_name' => 'web',
            ],
            [
                'name' => 'marketing',
                'guard_name' => 'web',
            ],
            [
                'name' => 'sales-manager',
                'guard_name' => 'web',
            ],
            [
                'name' => 'admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'ceo',
                'guard_name' => 'web',
            ],
            [
                'name' => 'user',
                'guard_name' => 'web',
            ],
            [
                'name' => 'guest',
                'guard_name' => 'web',
            ],
        ];
        foreach($permissions as $item) {
            $obj = Permission::where('name', $item['name'])->first();
            if(!$obj) {
                Permission::create($item);
            }
        }
    }

}
