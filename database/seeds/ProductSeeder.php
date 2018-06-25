<?php

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create(
            [
                'name' => '0001-01',
            ]
        );
        Product::create(
            [
                'name' => '0001-02',
            ]
        );
        Product::create(
            [
                'name' => '0001-03',
            ]
        );
        Product::create(
            [
                'name' => '0001-04',
            ]
        );
        Product::create(
            [
                'name' => '4032-29',
            ]
        );
        Product::create(
            [
                'name' => '4032-31',
            ]
        );
        Product::create(
            [
                'name' => '0631-02',
            ]
        );
        Product::create(
            [
                'name' => '0631-01',
            ]
        );
    }
}