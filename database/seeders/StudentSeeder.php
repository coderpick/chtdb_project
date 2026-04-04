<?php

namespace Database\Seeders;

use App\Models\Batch;
use App\Models\Career;
use App\Models\Course;
use App\Models\StudentProfile;
use App\Models\Training;
use App\Models\TrainingCenter;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $districts = ['rangamati', 'khagrachhari', 'bandarban'];
        $centers = TrainingCenter::all();
        $courses = Course::all();

        // Create some batches first if not exists
        foreach ($courses as $course) {
            Batch::firstOrCreate(
                ['course_id' => $course->id, 'name' => 'Batch-01'],
                [
                    'start_date' => now()->subMonths(6),
                    'end_date' => now()->subMonths(3),
                    'capacity' => 30,
                    'enrolled_count' => 0,
                    'status' => 'completed',
                ]
            );
        }

        $batches = Batch::all();

        // Create 50 students
        for ($i = 1; $i <= 50; $i++) {
            $district = $faker->randomElement($districts);
            $center = $centers->where('district', $district)->first();
            $course = $courses->random();
            $batch = $batches->where('course_id', $course->id)->first();

            $student = User::create([
                'name' => $faker->name,
                'email' => "student{$i}@example.com",
                'password' => Hash::make('password'),
                'role' => 'student',
            ]);

            // Profile
            StudentProfile::create([
                'user_id' => $student->id,
                'phone' => '01'.$faker->numerify('#########'),
                'district' => $district,
                'upazila' => $faker->city,
                'dob' => $faker->date('Y-m-d', '2005-01-01'),
                'gender' => $faker->randomElement(['male', 'female']),
                'bio' => $faker->sentence,
            ]);

            // Training
            Training::create([
                'user_id' => $student->id,
                'course_id' => $course->id,
                'center_id' => $center->id,
                'batch_id' => $batch->id,
                'status' => $faker->randomElement(['completed', 'completed', 'ongoing']),
                'start_date' => $batch->start_date,
                'end_date' => $batch->end_date,
                'grade' => $faker->randomElement(['A+', 'A', 'B+', 'A-']),
                'certificate_no' => 'CHTDB-'.date('Y').'-'.str_pad($i, 4, '0', STR_PAD_LEFT),
            ]);

            // Career (for 80% of students)
            if ($faker->boolean(80)) {
                Career::create([
                    'user_id' => $student->id,
                    'status' => $faker->randomElement(['job', 'freelance', 'entrepreneur']),
                    'income' => $faker->numberBetween(15000, 60000),
                    'company' => $faker->company,
                    'designation' => $faker->jobTitle,
                    'join_date' => $faker->date('Y-m-d', 'now'),
                    'location' => $faker->city,
                ]);
            }
        }
    }
}
