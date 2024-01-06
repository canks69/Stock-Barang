<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Makanan',
            ],
            [
                'name' => 'Minuman',
            ],
            [
                'name' => 'Snack',
            ]
        ];

        foreach ($data as $key => $value) {
            \App\Models\Category::create($value);
        }
    }
}
