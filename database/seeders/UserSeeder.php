<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
                    [
                        'name' => 'User',
                        'email' => 'user@news.com',
                        'email_verified_at' => now(),
                        'password' => Hash::make('123'),
                        'remember_token' => Str::random(10),
                        'role'=> UserRole::User
                    ],
                    [
                        'name' => 'Admin',
                        'email' => 'admin@news.com',
                        'email_verified_at' => now(),
                        'password' => Hash::make('123'),
                        'remember_token' => Str::random(10),
                        'role'=> UserRole::Admin
                    ],
                    [
                        'name' => 'Writter',
                        'email' => 'writter@news.com',
                        'email_verified_at' => now(),
                        'password' => Hash::make('123'),
                        'remember_token' => Str::random(10),
                        'role'=> UserRole::Writer
                    ]
                ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
