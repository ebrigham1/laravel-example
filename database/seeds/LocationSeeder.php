<?php

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::create(
            [
                'name' => 'A-1-A1',
            ]
        );
        Location::create(
            [
                'name' => 'A-1-A2',
            ]
        );
        Location::create(
            [
                'name' => 'A-1-B1',
            ]
        );
        Location::create(
            [
                'name' => 'A-1-B2',
            ]
        );
        Location::create(
            [
                'name' => 'B-1-A1',
            ]
        );
        Location::create(
            [
                'name' => 'B-1-A2',
            ]
        );
        Location::create(
            [
                'name' => 'B-1-B1',
            ]
        );
        Location::create(
            [
                'name' => 'B-1-B2',
            ]
        );
    }
}
