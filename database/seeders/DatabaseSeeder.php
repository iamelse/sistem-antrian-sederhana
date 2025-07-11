<?php

namespace Database\Seeders;

use App\Models\Queue;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'test@example.com',
            'role' => 'admin',
        ]);

        Queue::truncate();

        for ($i = 1; $i <= 20; $i++) {
            Queue::create([
                'number' => $i,
                'status' => 'waiting',
            ]);
        }
    }
}
