<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!User::where('email','admin@brilliance.com')->first())
        {
            $admin = User::create( [
                'name' => 'admin' ,
                'role' => 'admin' ,
                'email' => 'admin@brilliance.com' ,
                'password' => Hash::make( 'password' ) ,
            ] );
            $admin->assignRole('admin');
        }

        if(!User::where('email','ceo@brilliance.com')->first())
        {
            $user = User::create( [
                'name' => 'ceo' ,
                'role' => 'ceo' ,
                'email' => 'ceo@brilliance.com' ,
                'password' => Hash::make( 'password' ) ,
            ] );
            $user->assignRole('ceo');
        }

        if(!User::where('email','student@brilliance.com')->first())
        {
            $user = User::create( [
                'name' => 'student' ,
                'role' => 'student' ,
                'email' => 'student@brilliance.com' ,
                'password' => Hash::make( 'password' ) ,
            ] );
            $user->assignRole('student');
        }

        if(!User::where('email','doctor@brilliance.com')->first())
        {
            $user = User::create( [
                'name' => 'doctor' ,
                'role' => 'doctor' ,
                'email' => 'doctor@brilliance.com' ,
                'password' => Hash::make( 'password' ) ,
            ] );
            $user->assignRole('doctor');
        }

        if(!User::where('email','operation@brilliance.com')->first())
        {
            $user = User::create( [
                'name' => 'operation' ,
                'role' => 'operation' ,
                'email' => 'operation@brilliance.com' ,
                'password' => Hash::make( 'password' ) ,
            ] );
            $user->assignRole('operation');
        }

        if(!User::where('email','sales@brilliance.com')->first())
        {
            $user = User::create( [
                'name' => 'sales' ,
                'role' => 'sales' ,
                'email' => 'sales@brilliance.com' ,
                'password' => Hash::make( 'password' ) ,
            ] );
            $user->assignRole('sales');
        }

        if(!User::where('email','sales-manager@brilliance.com')->first())
        {
            $user = User::create( [
                'name' => 'sales' ,
                'role' => 'sales' ,
                'email' => 'sales-manager@brilliance.com' ,
                'password' => Hash::make( 'password' ) ,
            ] );
            $user->assignRole('sales-manager');
        }

        if(!User::where('email','marketing@brilliance.com')->first())
        {
            $user = User::create( [
                'name' => 'marketing' ,
                'role' => 'marketing' ,
                'email' => 'marketing@brilliance.com' ,
                'password' => Hash::make( 'password' ) ,
            ] );
            $user->assignRole('marketing');
        }

        if(!User::where('email','finance@brilliance.com')->first())
        {
            $user = User::create( [
                'name' => 'finance' ,
                'role' => 'finance' ,
                'email' => 'finance@brilliance.com' ,
                'password' => Hash::make( 'password' ) ,
            ] );
            $user->assignRole('finance');
        }

        if(!User::where('email','corporate@brilliance.com')->first())
        {
            $user = User::create( [
                'name' => 'corporate' ,
                'role' => 'corporate' ,
                'email' => 'corporate@brilliance.com' ,
                'password' => Hash::make( 'password' ) ,
            ] );
            $user->assignRole('corporate');
        }
    }
}
