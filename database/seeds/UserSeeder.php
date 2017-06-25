<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'name' => 'root',
                'email' => 'root@laravel.app',
                'password' => bcrypt('password'),
            ]
        );
        User::create(
            [
                'name' => 'Juan Di Diego',
                'email' => 'juand@laravel.app',
                'password' => bcrypt('password'),
            ]
        );
        User::create(
            [
                'name' => 'Ethan Brigham',
                'email' => 'ethanb@laravel.app',
                'password' => bcrypt('password'),
            ]
        );
        User::create(
            [
                'name' => 'Cody Miller',
                'email' => 'codym@laravel.app',
                'password' => bcrypt('password'),
            ]
        );
        User::create(
            [
                'name' => 'Hanna Davis',
                'email' => 'hannad@laravel.app',
                'password' => bcrypt('password'),
            ]
        );
        User::create(
            [
                'name' => 'Peter Jacobo',
                'email' => 'peterj@laravel.app',
                'password' => bcrypt('password'),
            ]
        );
        User::create(
            [
                'name' => 'Sales Manager',
                'email' => 'salesManager@laravel.app',
                'password' => bcrypt('password'),
            ]
        );
        User::create(
            [
                'name' => 'Sales Associate',
                'email' => 'salesAssociate@laravel.app',
                'password' => bcrypt('password'),
            ]
        );
        User::create(
            [
                'name' => 'Finance Manager',
                'email' => 'financeManager@laravel.app',
                'password' => bcrypt('password'),
            ]
        );
        User::create(
            [
                'name' => 'Finance Associate',
                'email' => 'financeAssociate@laravel.app',
                'password' => bcrypt('password'),
            ]
        );
        User::create(
            [
                'name' => 'Warehouse Manager',
                'email' => 'warehouseManager@laravel.app',
                'password' => bcrypt('password'),
            ]
        );
        User::create(
            [
                'name' => 'Warehouse Associate',
                'email' => 'warehouseAssociate@laravel.app',
                'password' => bcrypt('password'),
            ]
        );
    }
}
