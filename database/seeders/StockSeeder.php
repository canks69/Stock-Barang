<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'code' => 'P001',
                'name' => 'Indomie Goreng',
                'category_id' => 1,
                'price' => 2500,
                'cogs' => 2000,
                'initial' => 100
            ],
            [
                'code' => 'P002',
                'name' => 'Indomie Kuah',
                'category_id' => 1,
                'price' => 2500,
                'cogs' => 2000,
                'initial' => 100
            ],
            [
                'code' => 'P003',
                'name' => 'Teh Botol',
                'category_id' => 2,
                'price' => 5000,
                'cogs' => 4000,
                'initial' => 100
            ],
            [
                'code' => 'P004',
                'name' => 'Aqua',
                'category_id' => 2,
                'price' => 3000,
                'cogs' => 2000,
                'initial' => 100
            ],
            [
                'code' => 'P005',
                'name' => 'Chitato',
                'category_id' => 2,
                'price' => 5000,
                'cogs' => 4000,
                'initial' => 100
            ],
            [
                'code' => 'P006',
                'name' => 'Lays',
                'category_id' => 2,
                'price' => 5000,
                'cogs' => 4000,
                'initial' => 100
            ]
        ];

        foreach ($data as $key => $value) {
            \App\Models\Stock::create($value);
        }
    }
}
