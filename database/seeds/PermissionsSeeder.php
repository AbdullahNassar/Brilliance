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
                'name' => 'programs',
            ],
            [
                'name' => 'articles',
            ],
            [
                'name' => 'universities',
            ],
            [
                'name' => 'countries',
            ],
            [
                'name' => 'messages',
            ],
            [
                'name' => 'users',
            ],
            [
                'name' => 'guest',
            ],
        ];
        foreach ($permissions as $item) {
            $obj = Permission::where('name', $item['name'])->first();
            if (!$obj) {
                Permission::create($item);
            }
        }
    }

}
