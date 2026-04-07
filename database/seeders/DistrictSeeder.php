<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('districts')->insert([
            ['id' => 1, 'name' => 'Rangamati', 'bn_name' => 'রাঙামাটি'],
            ['id' => 2, 'name' => 'Khagrachhari', 'bn_name' => 'খাগড়াছড়ি'],
            ['id' => 3, 'name' => 'Bandarban', 'bn_name' => 'বান্দরবান'],
        ]);
    }
}
