<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $f = Faker::create();

        for ($i = 0; $i < 100; $i++) {
            User::create([
                'role_id' => $f->randomElement([1, 2]),
                'name' => $f->name(),
                'email' => $f->unique()->safeEmail(),
                'password' => Hash::make('password'),
            ]);
        }
    }
}
