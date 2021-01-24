<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'ceo',
                'guard_name' => 'web',
            ],
            [
                'name' => 'student',
                'guard_name' => 'web',
            ],
            [
                'name' => 'doctor',
                'guard_name' => 'web',
            ],
            [
                'name' => 'operation',
                'guard_name' => 'web',
            ],
            [
                'name' => 'finance',
                'guard_name' => 'web',
            ],
            [
                'name' => 'sales',
                'guard_name' => 'web',
            ],
            [
                'name' => 'marketing',
                'guard_name' => 'web',
            ],
            [
                'name' => 'corporate',
                'guard_name' => 'web',
            ],
            [
                'name' => 'sales-manager',
                'guard_name' => 'web',
            ],
        ];
        foreach ($roles as $item) {
            $obj = Role::where('name', $item['name'])->first();
            if (!$obj) {
                Role::create($item);
            }
        }

        $admin = Role::where('name', 'admin')->first();
        $adminRole = Role::find($admin->id);
        $adminRole->givePermissionTo(['sales','marketing','sales-manager','admin','ceo',
            'user','guest']);

        $sales = Role::where('name', 'sales')->first();
        $salesRole = Role::find($sales->id);
        $salesRole->givePermissionTo(['sales']);

        $marketing = Role::where('name', 'marketing')->first();
        $marketingRole = Role::find($marketing->id);
        $marketingRole->givePermissionTo(['marketing']);

        $salesManager = Role::where('name', 'sales-manager')->first();
        $managerRole = Role::find($salesManager->id);
        $managerRole->givePermissionTo(['sales-manager','sales']);
        
    }

}
