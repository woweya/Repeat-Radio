<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Events\UserAvatars;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->count(5)->create()->each(function ($user) {
            Event::dispatch(new UserAvatars($user));
        });

        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'gender' => 'male',
            'birthday' => '2000-01-01',
            'country' => 'Germany',
            'city' => 'Berlin',
            'password' => Hash::make('admin123'),
        ]);
    }
}
