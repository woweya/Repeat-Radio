<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Events\UserAvatars;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->count(5)->create()->each(function ($user) {
            \Illuminate\Support\Facades\Event::dispatch(new UserAvatars($user));
        });

     /*    $categories = ['Tech', 'Sports', 'Entertainment', 'Business', 'Health', 'Finance', 'Science'];
        foreach ($categories as $category) {
            \App\Models\Category::create([
                'name' => $category
            ]);
        } */

        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'gender' => 'male',
            'birthday' => '2000-01-01',
            'country' => 'Germany',
            'city' => 'Berlin',
            'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
            'is_staff' => true,
        ]);
    }
}
