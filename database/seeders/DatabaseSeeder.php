<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\{Category, Idea, Status};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Category::factory()->create(['name' => 'Laravel']);
        Category::factory()->create(['name' => 'AWS Lambda']);
        Category::factory()->create(['name' => 'Docker']);
        Category::factory()->create(['name' => 'Laravel Forge']);

        Status::factory()->create(['name' => 'Open']);
        Status::factory()->create(['name' => 'Considering']);
        Status::factory()->create(['name' => 'In Progress']);
        Status::factory()->create(['name' => 'Implemented']);
        Status::factory()->create(['name' => 'Closed']);

        Idea::factory(30)->create();
    }
}
