<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpazilaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('upazilas')->insert([

            // Rangamati (district_id = 1)
            ['district_id' => 1, 'name' => 'Rangamati Sadar', 'bn_name' => 'রাঙামাটি সদর'],
            ['district_id' => 1, 'name' => 'Kaptai', 'bn_name' => 'কাপ্তাই'],
            ['district_id' => 1, 'name' => 'Kawkhali', 'bn_name' => 'কাউখালী'],
            ['district_id' => 1, 'name' => 'Naniarchar', 'bn_name' => 'নানিয়ারচর'],
            ['district_id' => 1, 'name' => 'Baghaichhari', 'bn_name' => 'বাঘাইছড়ি'],
            ['district_id' => 1, 'name' => 'Juraichhari', 'bn_name' => 'জুরাইছড়ি'],
            ['district_id' => 1, 'name' => 'Rajasthali', 'bn_name' => 'রাজস্থলী'],
            ['district_id' => 1, 'name' => 'Belaichhari', 'bn_name' => 'বিলাইছড়ি'],
            ['district_id' => 1, 'name' => 'Barkal', 'bn_name' => 'বরকল'],
            ['district_id' => 1, 'name' => 'Langadu', 'bn_name' => 'লংগদু'],

            // Khagrachhari (district_id = 2)
            ['district_id' => 2, 'name' => 'Khagrachhari Sadar', 'bn_name' => 'খাগড়াছড়ি সদর'],
            ['district_id' => 2, 'name' => 'Dighinala', 'bn_name' => 'দীঘিনালা'],
            ['district_id' => 2, 'name' => 'Lakshmichhari', 'bn_name' => 'লক্ষ্মীছড়ি'],
            ['district_id' => 2, 'name' => 'Mahalchhari', 'bn_name' => 'মহালছড়ি'],
            ['district_id' => 2, 'name' => 'Manikchhari', 'bn_name' => 'মানিকছড়ি'],
            ['district_id' => 2, 'name' => 'Matiranga', 'bn_name' => 'মাটিরাঙ্গা'],
            ['district_id' => 2, 'name' => 'Panchhari', 'bn_name' => 'পানছড়ি'],
            ['district_id' => 2, 'name' => 'Ramgarh', 'bn_name' => 'রামগড়'],
            ['district_id' => 2, 'name' => 'Guimara', 'bn_name' => 'গুইমারা'],

            // Bandarban (district_id = 3)
            ['district_id' => 3, 'name' => 'Bandarban Sadar', 'bn_name' => 'বান্দরবান সদর'],
            ['district_id' => 3, 'name' => 'Lama', 'bn_name' => 'লামা'],
            ['district_id' => 3, 'name' => 'Alikadam', 'bn_name' => 'আলীকদম'],
            ['district_id' => 3, 'name' => 'Ruma', 'bn_name' => 'রুমা'],
            ['district_id' => 3, 'name' => 'Thanchi', 'bn_name' => 'থানচি'],
            ['district_id' => 3, 'name' => 'Naikhongchhari', 'bn_name' => 'নাইক্ষ্যংছড়ি'],
            ['district_id' => 3, 'name' => 'Rowangchhari', 'bn_name' => 'রোয়াংছড়ি'],
        ]);
    }
}
