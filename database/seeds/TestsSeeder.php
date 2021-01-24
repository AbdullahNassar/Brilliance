<?php

use Illuminate\Database\Seeder;
use App\Test;
use Spatie\Permission\Models\Role;
use App\User;

class TestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = User::where('role','admin')->get();
        foreach ($admins as $item) {
            $item->assignRole('admin');
        }

        $sales = User::where('role','sales')->get();
        foreach ($sales as $item) {
            $item->assignRole('sales');
        }

        $marketing = User::where('role','marketing')->get();
        foreach ($marketing as $item) {
            $item->assignRole('marketing');
        }

        $salesManagers = User::where('role','sales-manager')->get();
        foreach ($salesManagers as $item) {
            $item->assignRole('sales-manager');
        }
    }

}
