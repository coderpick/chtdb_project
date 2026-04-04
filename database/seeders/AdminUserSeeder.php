<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Skill;
use App\Models\TrainingCenter;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::updateOrCreate(
            ['email' => 'admin@chtdb.gov.bd'],
            [
                'name' => 'CHTDB Administrator',
                'password' => Hash::make('Admin@123456'), // Change in production!
                'role' => 'admin',
            ]
        );

        // Create a sample student for testing
        $student = User::updateOrCreate(
            ['email' => 'student@example.com'],
            [
                'name' => 'মং সাই মারমা',
                'password' => Hash::make('password123'),
                'role' => 'student',
            ]
        );

        // Get the rangamati center
        $center = TrainingCenter::where('district', 'rangamati')->first();
        $centerId = $center ? $center->id : null;

        // Get the Digital Marketing course
        $course = Course::where('slug', 'digital-marketing')->first();
        $courseId = $course ? $course->id : null;

        // Create related records for sample student
        $student->profile()->updateOrCreate(
            ['user_id' => $student->id],
            [
                'phone' => '01712345678',
                'district' => 'rangamati',
                'upazila' => 'Rangamati Sadar',
                'dob' => '1998-05-15',
                'gender' => 'female',
                'bio' => 'আইসিটি মার্কেটিং কোর্সে ভর্তি।',
            ]
        );

        // Only create training if both course and center exist
        if ($courseId && $centerId) {
            $student->training()->updateOrCreate(
                ['user_id' => $student->id],
                [
                    'course_id' => $courseId,
                    'center_id' => $centerId,
                    'status' => 'completed',
                    'start_date' => '2024-01-01',
                    'end_date' => '2024-03-31',
                    'certificate_no' => 'CHTDB-2024-001',
                    'grade' => 'A+',
                ]
            );
        }

        $student->career()->updateOrCreate(
            ['user_id' => $student->id],
            [
                'status' => 'job',
                'income' => 25000,
                'company' => 'CTG Solutions Ltd.',
                'designation' => 'Digital Marketing Executive',
                'join_date' => '2024-04-15',
                'location' => 'Chittagong',
            ]
        );

        $student->socialLinks()->updateOrCreate(
            ['user_id' => $student->id],
            [
                'linkedin' => 'https://linkedin.com/in/student',
                'github' => 'https://github.com/student',
            ]
        );

        $student->portfolioSetting()->updateOrCreate(
            ['user_id' => $student->id],
            [
                'slug' => 'mongsaimarma',
                'theme' => 'green',
                'is_visible' => true,
                'tagline' => 'Digital Marketing Specialist',
            ]
        );

        // Add some skills
        $skillNames = ['Digital Marketing', 'SEO', 'Social Media', 'Content Writing'];
        foreach ($skillNames as $skillName) {
            $skill = Skill::firstOrCreate(['name' => $skillName]);
            $student->skills()->syncWithoutDetaching([$skill->id]);
        }
    }
}
