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
            DistrictSeeder::class,
            UpazilaSeeder::class,
            CourseSeeder::class,
            CenterSeeder::class,
            BatchSeeder::class,
            SkillSeeder::class,
            AdminUserSeeder::class,
            StudentSeeder::class,
            SuccessStorySeeder::class,
            GallerySeeder::class,
        ]);
    }
}
