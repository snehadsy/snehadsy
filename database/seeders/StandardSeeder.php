<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StandardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $standards = [
            'I', 'II', 'III', 'IV', 'V',
            'VI', 'VII', 'VIII', 'IX', 'X'
        ];

        foreach ($standards as $standard) {
            DB::table('standards')->insert([
                'name' => $standard
            ]);
        }
    }
}
