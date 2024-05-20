<?php

namespace Database\Seeders;
use Illuminate\Support\Str;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
        ]);
        // \App\Models\User::factory(1)->create();

        // \App\Models\User::factory()->create([
        //     [
        //         'name' => 'User',
        //         'email' => 'user@news.com',
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('123'),
        //         'remember_token' => Str::random(10),
        //         'role'=> UserRole::User
        //     ],
        //     [
        //         'name' => 'Admin',
        //         'email' => 'admin@news.com',
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('123'),
        //         'remember_token' => Str::random(10),
        //         'role_id'=> UserRole::Admin
        //     ],
        //     [
        //         'name' => 'Writter',
        //         'email' => 'writter@news.com',
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('123'),
        //         'remember_token' => Str::random(10),
        //         'role_id'=> UserRole::Writer
        //     ]
        // ]);
        
    }
}
