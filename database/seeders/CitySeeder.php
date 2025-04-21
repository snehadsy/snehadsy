<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\District;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pune = District::where('name', 'Pune')->first();
        $mumbai = District::where('name', 'Mumbai')->first();
        $bengaluru = District::where('name', 'Bengaluru')->first();

        City::insert([
            ['name' => 'Shivajinagar', 'district_xid' => $pune->id, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Wakad', 'district_xid' => $pune->id, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Andheri', 'district_xid' => $mumbai->id, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Koramangala', 'district_xid' => $bengaluru->id, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
