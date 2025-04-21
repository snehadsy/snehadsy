<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $maharashtra = State::where('name', 'Maharashtra')->first();
        $karnataka = State::where('name', 'Karnataka')->first();

        District::insert([
            ['name' => 'Pune', 'state_xid' => $maharashtra->id, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mumbai', 'state_xid' => $maharashtra->id, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bengaluru', 'state_xid' => $karnataka->id, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
