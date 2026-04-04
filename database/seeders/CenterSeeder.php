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
                'name' => 'পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড - রাঙামাটি শাখা',
                'district' => 'rangamati',
                'address' => 'Rangamati, Chittagong Hill Tracts',
                'phone' => '+880-351-62081',
                'email' => 'rangamati@chtdb.gov.bd',
                'total_trainee' => 120,
                'is_active' => true,
            ],
            [
                'name' => 'পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড - খাগড়াছড়ি শাখা',
                'district' => 'khagrachhari',
                'address' => 'Khagrachhari, Chittagong Hill Tracts',
                'phone' => '+880-351-62082',
                'email' => 'khagrachhari@chtdb.gov.bd',
                'total_trainee' => 80,
                'is_active' => true,
            ],
            [
                'name' => 'পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড - বান্দরবান শাখা',
                'district' => 'bandarban',
                'address' => 'Bandarban, Chittagong Hill Tracts',
                'phone' => '+880-351-62083',
                'email' => 'bandarban@chtdb.gov.bd',
                'total_trainee' => 70,
                'is_active' => true,
            ],
        ];

        foreach ($centers as $center) {
            TrainingCenter::updateOrCreate(
                ['district' => $center['district']],
                $center
            );
        }
    }
}
