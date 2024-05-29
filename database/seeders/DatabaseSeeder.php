<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Conference;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table('conferences')->truncate();

        Conference::create([
            'title' => 'Test Conference 0',
            'description' => 'Today top description: The quick brown fox jumps over the lazy dog.!?',
            'date' => now(),
            'address' => 'Random St 1, City, Country',
            'participants' => 3,
        ]);

        Conference::create([
            'title' => 'Test Conference 1',
            'description' => '123+34567=89-*/ is the description.',
            'date' => now()->addDays(31),
            'address' => 'Random St 2, City, Country',
            'participants' => 10,
        ]);

        Conference::create([
            'title' => 'Test Conference 2',
            'description' => '',
            'date' => now()->subDays(31),
            'address' => 'Random St 3, City, Country',
            'participants' => 1000,
        ]);
    }
}

