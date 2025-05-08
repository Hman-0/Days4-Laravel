<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Tạo 5 người dùng với profile
        for ($i = 1; $i <= 5; $i++) {
            $user = User::create([
                'name' => "User $i",
                'email' => "user$i@example.com",
                'password' => Hash::make('password'),
            ]);

            Profile::create([
                'user_id' => $user->id,
                'bio' => "Bio của User $i",
                'birthday' => "1990-01-0$i",
                'avatar_url' => "https://via.placeholder.com/150?text=User$i",
            ]);
        }
    }
}