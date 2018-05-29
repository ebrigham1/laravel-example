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
                'email' => 'root@laravel.test',
                'password' => bcrypt('password'),
            ]
        );
        User::create(
            [
                'name' => 'Juan Di Diego',
                'email' => 'juand@laravel.test',
                'password' => bcrypt('password'),
            ]
        );
        User::create(
            [
                'name' => 'Ethan Brigham',
                'email' => 'ethanb@laravel.test',
                'password' => bcrypt('password'),
            ]
        );
        User::create(
            [
                'name' => 'Cody Miller',
                'email' => 'codym@laravel.test',
                'password' => bcrypt('password'),
            ]
        );
        User::create(
            [
                'name' => 'Hanna Davis',
                'email' => 'hannad@laravel.test',
                'password' => bcrypt('password'),
            ]
        );
        User::create(
            [
                'name' => 'Peter Jacobo',
                'email' => 'peterj@laravel.test',
                'password' => bcrypt('password'),
            ]
        );
        User::create(
            [
                'name' => 'Sales Manager',
                'email' => 'salesManager@laravel.test',
                'password' => bcrypt('password'),
            ]
        );
        User::create(
            [
                'name' => 'Sales Associate',
                'email' => 'salesAssociate@laravel.test',
                'password' => bcrypt('password'),
            ]
        );
        User::create(
            [
                'name' => 'Finance Manager',
                'email' => 'financeManager@laravel.test',
                'password' => bcrypt('password'),
            ]
        );
        User::create(
            [
                'name' => 'Finance Associate',
                'email' => 'financeAssociate@laravel.test',
                'password' => bcrypt('password'),
            ]
        );
        User::create(
            [
                'name' => 'Warehouse Manager',
                'email' => 'warehouseManager@laravel.test',
                'password' => bcrypt('password'),
            ]
        );
        User::create(
            [
                'name' => 'Warehouse Associate',
                'email' => 'warehouseAssociate@laravel.test',
                'password' => bcrypt('password'),
            ]
        );
    }
}
