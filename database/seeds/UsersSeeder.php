<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

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
                'email' => 'admin@brilliance.com' ,
                'password' => Hash::make( 'password' ) ,
            ] );
            $admin->assignRole('admin');
        }

        if(!User::where('email','ceo@brilliance.com')->first())
        {
            $user = User::create( [
                'name' => 'ceo' ,
                'email' => 'ceo@brilliance.com' ,
                'password' => Hash::make( 'password' ) ,
            ] );
            $user->assignRole('ceo');
        }

        if(!User::where('email','student@brilliance.com')->first())
        {
            $user = User::create( [
                'name' => 'user' ,
                'email' => 'student@brilliance.com' ,
                'password' => Hash::make( 'password' ) ,
            ] );
            $user->assignRole('student');
        }

        if(!User::where('email','doctor@brilliance.com')->first())
        {
            $user = User::create( [
                'name' => 'doctor' ,
                'email' => 'doctor@brilliance.com' ,
                'password' => Hash::make( 'password' ) ,
            ] );
            $user->assignRole('doctor');
        }

        if(!User::where('email','operation@brilliance.com')->first())
        {
            $user = User::create( [
                'name' => 'operation' ,
                'email' => 'operation@brilliance.com' ,
                'password' => Hash::make( 'password' ) ,
            ] );
            $user->assignRole('operation');
        }

        if(!User::where('email','sales@brilliance.com')->first())
        {
            $user = User::create( [
                'name' => 'sales' ,
                'email' => 'sales@brilliance.com' ,
                'password' => Hash::make( 'password' ) ,
            ] );
            $user->assignRole('sales');
        }

        if(!User::where('email','marketing@brilliance.com')->first())
        {
            $user = User::create( [
                'name' => 'marketing' ,
                'email' => 'marketing@brilliance.com' ,
                'password' => Hash::make( 'password' ) ,
            ] );
            $user->assignRole('marketing');
        }

        if(!User::where('email','finance@brilliance.com')->first())
        {
            $user = User::create( [
                'name' => 'finance' ,
                'email' => 'finance@brilliance.com' ,
                'password' => Hash::make( 'password' ) ,
            ] );
            $user->assignRole('finance');
        }

        if(!User::where('email','corporate@brilliance.com')->first())
        {
            $user = User::create( [
                'name' => 'corporate' ,
                'email' => 'corporate@brilliance.com' ,
                'password' => Hash::make( 'password' ) ,
            ] );
            $user->assignRole('corporate');
        }
    }
}
