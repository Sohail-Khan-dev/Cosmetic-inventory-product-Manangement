<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = collect([
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'created_at' => now(),
                'uuid' => Str::uuid(),
                'photo' => 'profile-1.jpg'
            ],
            [
                'name' => 'quest',
                'email' => 'quest@quest.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'created_at' => now(),
                'uuid' => Str::uuid(),
                'photo' => 'profile-2.jpg'
            ],
            [
                'name' => 'user',
                'email' => 'user@user.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'created_at' => now(),
                'uuid' => Str::uuid(),
                'photo' => 'profile-3.jpg'
            ]
        ]);

        $users->each(function ($user) {
            User::insert($user);
        });
    }
}
