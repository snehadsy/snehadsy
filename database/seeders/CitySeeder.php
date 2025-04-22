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
    $mumbai = District::where('name', 'Mumbai City')->first();
    $bengaluru = District::where('name', 'Bengaluru Urban')->first();
    $mysuru = District::where('name', 'Mysuru')->first();
    $ahmedabad = District::where('name', 'Ahmedabad')->first();
    $surat = District::where('name', 'Surat')->first();
    $chennai = District::where('name', 'Chennai')->first();
    $coimbatore = District::where('name', 'Coimbatore')->first();
    $kolkata = District::where('name', 'Kolkata')->first();
    $darjeeling = District::where('name', 'Darjeeling')->first();

    City::insert([
        // Pune
        ['name' => 'Shivajinagar', 'district_xid' => $pune->id, 'created_at' => now(), 'updated_at' => now()],
        ['name' => 'Wakad', 'district_xid' => $pune->id, 'created_at' => now(), 'updated_at' => now()],

        // Mumbai City
        ['name' => 'Andheri', 'district_xid' => $mumbai->id, 'created_at' => now(), 'updated_at' => now()],
        ['name' => 'Borivali', 'district_xid' => $mumbai->id, 'created_at' => now(), 'updated_at' => now()],

        // Bengaluru Urban
        ['name' => 'Koramangala', 'district_xid' => $bengaluru->id, 'created_at' => now(), 'updated_at' => now()],
        ['name' => 'Whitefield', 'district_xid' => $bengaluru->id, 'created_at' => now(), 'updated_at' => now()],

        // Mysuru
        ['name' => 'Jayalakshmipuram', 'district_xid' => $mysuru->id, 'created_at' => now(), 'updated_at' => now()],
        ['name' => 'VV Mohalla', 'district_xid' => $mysuru->id, 'created_at' => now(), 'updated_at' => now()],

        // Ahmedabad
        ['name' => 'Navrangpura', 'district_xid' => $ahmedabad->id, 'created_at' => now(), 'updated_at' => now()],
        ['name' => 'Maninagar', 'district_xid' => $ahmedabad->id, 'created_at' => now(), 'updated_at' => now()],

        // Surat
        ['name' => 'Adajan', 'district_xid' => $surat->id, 'created_at' => now(), 'updated_at' => now()],
        ['name' => 'Katargam', 'district_xid' => $surat->id, 'created_at' => now(), 'updated_at' => now()],

        // Chennai
        ['name' => 'T. Nagar', 'district_xid' => $chennai->id, 'created_at' => now(), 'updated_at' => now()],
        ['name' => 'Velachery', 'district_xid' => $chennai->id, 'created_at' => now(), 'updated_at' => now()],

        // Coimbatore
        ['name' => 'Gandhipuram', 'district_xid' => $coimbatore->id, 'created_at' => now(), 'updated_at' => now()],
        ['name' => 'RS Puram', 'district_xid' => $coimbatore->id, 'created_at' => now(), 'updated_at' => now()],

        // Kolkata
        ['name' => 'Salt Lake', 'district_xid' => $kolkata->id, 'created_at' => now(), 'updated_at' => now()],
        ['name' => 'Howrah', 'district_xid' => $kolkata->id, 'created_at' => now(), 'updated_at' => now()],

        // Darjeeling
        ['name' => 'Kurseong', 'district_xid' => $darjeeling->id, 'created_at' => now(), 'updated_at' => now()],
        ['name' => 'Mirik', 'district_xid' => $darjeeling->id, 'created_at' => now(), 'updated_at' => now()],
    ]);
}

}