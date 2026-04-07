<?php

namespace Database\Seeders;

use App\Models\TrainingCenter;
use Illuminate\Database\Seeder;

class CenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $centers = [
            [
                'district_id' => 1,
                'name' => 'পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড - রাঙামাটি শাখা',
                'address' => 'Rangamati, Chittagong Hill Tracts',
                'phone' => '+880-351-62081',
                'email' => 'rangamati@chtdb.gov.bd',
                'total_trainee' => 80,
                'is_active' => true,
            ],
            [
                'district_id' => 2,
                'name' => 'পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড - খাগড়াছড়ি শাখা',
                'address' => 'Khagrachhari, Chittagong Hill Tracts',
                'phone' => '+880-351-62082',
                'email' => 'khagrachhari@chtdb.gov.bd',
                'total_trainee' => 60,
                'is_active' => true,
            ],
            [
                'district_id' => 3,
                'name' => 'পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড - বান্দরবান শাখা',
                'address' => 'Bandarban, Chittagong Hill Tracts',
                'phone' => '+880-351-62083',
                'email' => 'bandarban@chtdb.gov.bd',
                'total_trainee' => 60,
                'is_active' => true,
            ],
        ];

        foreach ($centers as $center) {
            TrainingCenter::updateOrCreate(
                ['district_id' => $center['district_id']],
                $center
            );
        }
    }
}
