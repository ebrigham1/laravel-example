<?php

use Illuminate\Database\Seeder;
use App\Models\Section;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Section::create(
            [
                'name' => 'L1',
                'warehouse_id' => 1,
            ]
        );
        Section::create(
            [
                'name' => 'LS',
                'warehouse_id' => 1,
            ]
        );
        Section::create(
            [
                'name' => 'L5',
                'warehouse_id' => 1,
            ]
        );
        Section::create(
            [
                'name' => 'R',
                'warehouse_id' => 2,
            ]
        );
        Section::create(
            [
                'name' => 'LSR',
                'warehouse_id' => 2,
            ]
        );
        Section::create(
            [
                'name' => 'S1',
                'warehouse_id' => 3,
            ]
        );
        Section::create(
            [
                'name' => 'S',
                'warehouse_id' => 3,
            ]
        );
    }
}