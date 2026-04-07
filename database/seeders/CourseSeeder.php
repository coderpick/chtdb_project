<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $courses = [
            [
                'name' => 'বেসিক কম্পিউটার ফান্ডামেন্টাল',
                'slug' => 'basic-computer-fundamentals',
                'description' => 'কম্পিউটারের মৌলিক ধারণা, এমএস অফিস এবং ইন্টারনেট ব্যবহারের প্রাথমিক শিক্ষা।',
                'icon' => 'bi-laptop',
                'color' => '#3b82f6',
                'duration_weeks' => 8,
                'order' => 1,
            ],
            [
                'name' => 'গ্রাফিক ডিজাইন',
                'slug' => 'graphic-design',
                'description' => 'অ্যাডোবি ফটোশপ এবং ইলাস্ট্রেটর ব্যবহার করে প্রফেশনাল ডিজাইন তৈরি।',
                'icon' => 'bi-palette',
                'color' => '#ec4899',
                'duration_weeks' => 12,
                'order' => 2,
            ],
            [
                'name' => 'ডিজিটাল মার্কেটিং',
                'slug' => 'digital-marketing',
                'description' => 'এসইও, সোশ্যাল মিডিয়া মার্কেটিং এবং অনলাইন অ্যাডভার্টাইজিং।',
                'icon' => 'bi-megaphone',
                'color' => '#ef4444',
                'duration_weeks' => 10,
                'order' => 3,
            ],
            [
                'name' => 'অডিও ও ভিডিও এডিটিং',
                'slug' => 'audio-video',
                'description' => 'প্রফেশনাল ভিডিও এডিটিং এবং অডিও মিক্সিং টেকনিক।',
                'icon' => 'bi-camera-video',
                'color' => '#f59e0b',
                'duration_weeks' => 8,
                'order' => 4,
            ],
            [
                'name' => 'ওয়েব ডিজাইন',
                'slug' => 'web-design',
                'description' => 'এইচটিএমএল, সিএসএস এবং বুটস্ট্র্যাপ ব্যবহার করে রেসপনসিভ ওয়েবসাইট ডিজাইন।',
                'icon' => 'bi-code-slash',
                'color' => '#10b981',
                'duration_weeks' => 12,
                'order' => 5,
            ],
            [
                'name' => '২ডি ও ৩ডি এনিমেশন',
                'slug' => '2d-3d-animation',
                'description' => 'ক্যারেক্টার এনিমেশন এবং ৩ডি মডেলিংয়ের উন্নত কলাকৌশল।',
                'icon' => 'bi-activity',
                'color' => '#8b5cf6',
                'duration_weeks' => 16,
                'order' => 6,
            ],
        ];

        foreach ($courses as $course) {
            Course::updateOrCreate(
                ['slug' => $course['slug']],
                $course
            );
        }
    }
}
