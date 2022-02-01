<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //users
        User::create(['name' => 'noname', 'email' => 'noname@kot.com', 'password' => Hash::make(Str::random()), 'key' => 1]);
        User::create(['name' => 'kot', 'email' => 'kot@kot.com', 'password' => Hash::make(123), 'key' => rand(1,3)]);

        //languages
        Language::create(['user_id' => 2, 'title' => 'Английский язык']);
        Language::create(['user_id' => 2, 'title' => 'Грузинский язык']);
    }
}
