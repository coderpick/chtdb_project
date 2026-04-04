<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CourseSeeder::class,
            CenterSeeder::class,
            SkillSeeder::class,
            AdminUserSeeder::class,
            TestimonialSeeder::class,
            GallerySeeder::class,
            StudentSeeder::class,
        ]);
    }
}
