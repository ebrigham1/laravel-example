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
                'type' => 'primary',
                'warehouse_id' => 1,
            ]
        );
        Section::create(
            [
                'name' => 'LS',
                'type' => 'sample',
                'warehouse_id' => 1,
            ]
        );
        Section::create(
            [
                'name' => 'L5',
                'type' => 'surplus',
                'warehouse_id' => 1,
            ]
        );
        Section::create(
            [
                'name' => 'R',
                'type' => 'primary',
                'warehouse_id' => 2,
            ]
        );
        Section::create(
            [
                'name' => 'LSR',
                'type' => 'sample',
                'warehouse_id' => 2,
            ]
        );
        Section::create(
            [
                'name' => 'S1',
                'type' => 'primary',
                'warehouse_id' => 3,
            ]
        );
        Section::create(
            [
                'name' => 'S2',
                'type' => 'sample',
                'warehouse_id' => 3,
            ]
        );
    }
}