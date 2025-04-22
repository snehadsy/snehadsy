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
        $gujarat = State::where('name', 'Gujarat')->first();
        $tamilNadu = State::where('name', 'Tamil Nadu')->first();
        $westBengal = State::where('name', 'West Bengal')->first();

        District::insert([
            // Maharashtra
            ['name' => 'Pune', 'state_xid' => $maharashtra->id, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mumbai City', 'state_xid' => $maharashtra->id, 'created_at' => now(), 'updated_at' => now()],

            // Karnataka
            ['name' => 'Bengaluru Urban', 'state_xid' => $karnataka->id, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mysuru', 'state_xid' => $karnataka->id, 'created_at' => now(), 'updated_at' => now()],

            // Gujarat
            ['name' => 'Ahmedabad', 'state_xid' => $gujarat->id, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Surat', 'state_xid' => $gujarat->id, 'created_at' => now(), 'updated_at' => now()],

            // Tamil Nadu
            ['name' => 'Chennai', 'state_xid' => $tamilNadu->id, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Coimbatore', 'state_xid' => $tamilNadu->id, 'created_at' => now(), 'updated_at' => now()],

            // West Bengal
            ['name' => 'Kolkata', 'state_xid' => $westBengal->id, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Darjeeling', 'state_xid' => $westBengal->id, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

}
