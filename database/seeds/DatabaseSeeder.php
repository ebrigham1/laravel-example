<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(WarehouseSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(ProductSeeder::class);
    }
}
