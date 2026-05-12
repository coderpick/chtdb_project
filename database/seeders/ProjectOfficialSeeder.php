<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ProjectOfficial;

class ProjectOfficialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $officials = [
            [
                'name' => 'জনাব সুপ্রদীপ চাকমা',
                'designation' => 'চেয়ারম্যান (সিনিয়র সচিব)',
                'organization' => 'পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড',
                'image' => 'img/officials/chairman.png',
                'order' => 1,
            ],
            [
                'name' => 'জনাব মো: জসিম উদ্দিন',
                'designation' => 'প্রকল্প পরিচালক',
                'organization' => 'আইসিটি দক্ষতা উন্নয়ন স্কিম',
                'image' => 'img/officials/project_director.png',
                'order' => 2,
            ],
            [
                'name' => 'জনাব মো: হারুন-অর-রশীদ',
                'designation' => 'সদস্য (পরিকল্পনা)',
                'organization' => 'পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড',
                'image' => 'img/officials/member_planning.png',
                'order' => 3,
            ],
            [
                'name' => 'জনাব আবু বিন হাসান',
                'designation' => 'প্রকল্প সমন্বয়কারী',
                'organization' => 'PeopleNTech Institute of IT',
                'image' => 'img/officials/project_manager.png',
                'order' => 4,
            ],
        ];

        foreach ($officials as $official) {
            ProjectOfficial::create($official);
        }
    }
}
