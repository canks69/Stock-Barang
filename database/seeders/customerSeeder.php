<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class customerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'code' => 'C0001',
                'name' => 'Rizky',
                'email' => 'rizky@email.com',
                'phone' => '081234567890',
                'address' => 'Jl. Raya No. 1'
            ],
            [
                'code' => 'C0002',
                'name' => 'Asep 2',
                'email' => 'asep@email.com',
                'phone' => '081234567891',
                'address' => 'Jl. Raya No. 2'
            ],
        ];

        foreach ($data as $key => $value) {
            \App\Models\Customer::create($value);
        }
    }
}
