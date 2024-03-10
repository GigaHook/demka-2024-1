<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(range(0, 100) as $i) {
            User::first()->orders()->create([
                'number' => Str::random(6),
                'description' => fake()->text(),
            ]);
        }
    }
}
