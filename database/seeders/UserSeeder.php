<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Generate 10 user random
        User::factory()
            ->count(10)
            ->sequence(
                fn ($sequence) => ['role' => $sequence->index % 2 === 0 ? 'staff' : 'user']
            )
            ->create([
                'password' => bcrypt('password') // Semua pakai password yang sama
            ]);
    }
}