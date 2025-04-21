<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        State::insert([
            ['name' => 'Maharashtra', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Karnataka', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
