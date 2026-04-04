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
                'name' => 'ওয়েব ডেভেলপমেন্ট',
                'slug' => 'web-development',
                'description' => 'HTML, CSS, JavaScript, PHP, MySQL ও Laravel শিখুন।',
                'icon' => 'bi-code-slash',
                'color' => '#3b82f6',
                'duration_weeks' => 16,
                'order' => 1,
            ],
            [
                'name' => 'গ্রাফিক ডিজাইন',
                'slug' => 'graphic-design',
                'description' => 'Photoshop, Illustrator ও UI/UX ডিজাইন।',
                'icon' => 'bi-palette',
                'color' => '#ec4899',
                'duration_weeks' => 12,
                'order' => 2,
            ],
            [
                'name' => 'মোবাইল অ্যাপ ডেভেলপমেন্ট',
                'slug' => 'mobile-app-development',
                'description' => 'Android/iOS แล้วabelle শিখুন।',
                'icon' => 'bi-phone',
                'color' => '#14b8a6',
                'duration_weeks' => 16,
                'order' => 3,
            ],
            [
                'name' => 'ডিজিটাল মার্কেটিং',
                'slug' => 'digital-marketing',
                'description' => 'SEO, Social Media Marketing, Google Ads।',
                'icon' => 'bi-megaphone',
                'color' => '#ef4444',
                'duration_weeks' => 10,
                'order' => 4,
            ],
            [
                'name' => 'ডাটাবেজ ম্যানেজমেন্ট',
                'slug' => 'database-management',
                'description' => 'MySQL, PostgreSQL ও MongoDB ব্যবস্থাপনা।',
                'icon' => 'bi-database',
                'color' => '#8b5cf6',
                'duration_weeks' => 8,
                'order' => 5,
            ],
            [
                'name' => 'ই-কমার্স',
                'slug' => 'e-commerce',
                'description' => 'Online business setup, WooCommerce, payment integration।',
                'icon' => 'bi-cart3',
                'color' => '#10b981',
                'duration_weeks' => 8,
                'order' => 6,
            ],
            [
                'name' => 'সাইবার সিকিউরিটি',
                'slug' => 'cyber-security',
                'description' => 'Network security, ethical hacking, data protection।',
                'icon' => 'bi-shield-lock',
                'color' => '#4b5563',
                'duration_weeks' => 12,
                'order' => 7,
            ],
            [
                'name' => 'ভিডিও এডিটিং',
                'slug' => 'video-editing',
                'description' => 'Adobe Premiere Pro, After Effects শিখুন।',
                'icon' => 'bi-camera-video',
                'color' => '#dc2626',
                'duration_weeks' => 8,
                'order' => 8,
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
