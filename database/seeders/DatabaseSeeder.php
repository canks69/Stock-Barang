<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@email.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);

        $this->call([
            DataCategorySeeder::class,
            customerSeeder::class,
            StockSeeder::class,
        ]);
    }
}
