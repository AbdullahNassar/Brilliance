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
            ],
            [
                'name' => 'ceo',
            ],
            [
                'name' => 'student',
            ],
            [
                'name' => 'doctor',
            ],
            [
                'name' => 'operation',
            ],
            [
                'name' => 'finance',
            ],
            [
                'name' => 'sales',
            ],
            [
                'name' => 'marketing',
            ],
            [
                'name' => 'corporate',
            ],
        ];
        foreach ($roles as $item) {
            $obj = Role::where('name', $item['name'])->first();
            if (!$obj) {
                Role::create($item);
            }
        }
    }

}
