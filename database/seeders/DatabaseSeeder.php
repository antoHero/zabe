<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\{Category, Idea, Status, User, Vote};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Akoke Anto',
            'email' => 'veeqanto@gmail.com',
        ]);

        User::factory(19)->create();

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

        Idea::factory(100)->create();

        // Generate unique votes and ensure idea_id and user_id are unique for each row

        foreach(range(1, 20) as $user_id) {
            foreach(range(1, 100) as $idea_id) {
                if($idea_id % 2 == 0) {
                    Vote::factory()->create([
                        'user_id' => $user_id,
                        'idea_id' => $idea_id
                    ]);
                }
            }
        }
    }
}
