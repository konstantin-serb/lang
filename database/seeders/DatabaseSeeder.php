<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Section;
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

        Section::create(['user_id' => 2, 'language' => 1, 'parent_id' => null, 'title' => 'Фразы', ]);
        Section::create(['user_id' => 2, 'language' => 1, 'parent_id' => 1, 'title' => 'Времена', ]);
        Section::create(['user_id' => 2, 'language' => 1, 'parent_id' => 2, 'title' => 'Past simple', ]);
        Section::create(['user_id' => 2, 'language' => 1, 'parent_id' => 2, 'title' => 'Present simple', ]);
        Section::create(['user_id' => 2, 'language' => 1, 'parent_id' => 2, 'title' => 'Future simple', ]);
    }
}
