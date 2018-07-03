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
                'section_id' => 4,
            ]
        );
        Location::create(
            [
                'name' => 'A-1-A2',
                'section_id' => 4,
            ]
        );
        Location::create(
            [
                'name' => 'A-1-B1',
                'section_id' => 4,
            ]
        );
        Location::create(
            [
                'name' => 'A-1-B2',
                'section_id' => 4,
            ]
        );
        Location::create(
            [
                'name' => 'B-1-A1',
                'section_id' => 4,
            ]
        );
        Location::create(
            [
                'name' => 'B-1-A2',
                'section_id' => 4,
            ]
        );
        Location::create(
            [
                'name' => 'B-1-B1',
                'section_id' => 4,
            ]
        );
        Location::create(
            [
                'name' => 'B-1-B2',
                'section_id' => 4,
            ]
        );
        Location::create(
            [
                'name' => '15A1',
                'section_id' => 1,
            ]
        );
        Location::create(
            [
                'name' => '15A2',
                'section_id' => 1,
            ]
        );
        Location::create(
            [
                'name' => '15B1',
                'section_id' => 1,
            ]
        );
        Location::create(
            [
                'name' => '15B2',
                'section_id' => 1,
            ]
        );
        Location::create(
            [
                'name' => '15D1',
                'section_id' => 1,
            ]
        );
        Location::create(
            [
                'name' => '15D2',
                'section_id' => 1,
            ]
        );
        Location::create(
            [
                'name' => '15E1',
                'section_id' => 1,
            ]
        );
        Location::create(
            [
                'name' => '15E2',
                'section_id' => 1,
            ]
        );
        Location::create(
            [
                'name' => 'S-1-A1',
                'section_id' => 6,
            ]
        );
        Location::create(
            [
                'name' => 'S-1-A2',
                'section_id' => 6,
            ]
        );
        Location::create(
            [
                'name' => 'S-1-B1',
                'section_id' => 6,
            ]
        );
        Location::create(
            [
                'name' => 'S-1-B1',
                'section_id' => 6,
            ]
        );
        Location::create(
            [
                'name' => 'RENO TRANSIT',
                'section_id' => null,
            ]
        );
        Location::create(
            [
                'name' => 'SARATOGA TRANSIT',
                'section_id' => null,
            ]
        );
    }
}
