<?php

use Illuminate\Database\Seeder;
use App\Models\Warehouse;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Warehouse::create(
            [
                'name' => 'Watervliet',
            ]
        );
        Warehouse::create(
            [
                'name' => 'Reno',
            ]
        );
        Warehouse::create(
            [
                'name' => 'Saratoga',
            ]
        );
    }
}