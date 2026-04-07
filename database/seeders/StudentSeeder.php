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
        $courses = Course::all();
        $centers = TrainingCenter::all();

        $bengaliNames = [
            'মং সাই মারমা', 'প্রিয়াংকা চাকমা', 'উ চিং মং মারমা', 'কল্পনা ত্রিপুরা',
            'সুমিত চাকমা', 'মেনুকা তঞ্চঙ্গ্যা', 'রাজীব তালুকদার', 'সুষমা দেওয়ান',
            'অং থুই প্রু মারমা', 'রূপালী চাকমা', 'বিমল কান্তি চাকমা', 'ক্লোইং মারমা',
            'সুইটি চাকমা', 'জেমস ত্রিপুরা', 'উক্য সিং মারমা', 'হ্লামং প্রু',
            'বাসন্তী তঞ্চঙ্গ্যা', 'চানু মং মারমা', 'সুব্রত চাকমা', 'জুই চাকমা',
            'কিরণ তালুকদার', 'নুশৈ মারমা', 'উমেচিং ত্রিপুরা', 'মিলন দেওয়ান',
            'বিপাশা চাকমা', 'সুজন তঞ্চঙ্গ্যা', 'প্রীতি ত্রিপুরা', 'ক্যসুই মারমা',
            'রিম্পা চাকমা', 'আশিস দেওয়ান', 'স্নিগ্ধা চাকমা', 'অংসুই প্রু মারমা',
        ];

        $careerTitles = [
            'জুনিয়র ওয়েব ডেভেলপার',
            'গ্রাফিক ডিজাইনার',
            'ফ্রন্টএন্ড ডেভেলপার',
            'ডিজিটাল মার্কেটার',
            'ডেটাবেজ অ্যাডমিনিস্ট্রেটর',
            'এসইও এক্সপার্ট',
            'ইউআই/ইউএক্স ডিজাইনার',
            'মোবাইল অ্যাপ ডেভেলপার',
            'ফ্রি-ল্যান্স ওয়েব ডেভেলপার',
            'সাইবার সিকিউরিটি স্পেশালিস্ট',
            'ভিডিও এডিটর',
        ];

        $nameIndex = 0;

        foreach ($centers as $center) {
            $batches = Batch::where('training_center_id', $center->id)->get();

            foreach ($batches as $batch) {
                // Determine capacity based on center and user request
                // We create ~10-15 students per batch just to achieve overall 30+ easily with rich data
                $count = 15;

                for ($i = 1; $i <= $count; $i++) {
                    $studentName = $bengaliNames[$nameIndex % count($bengaliNames)];
                    $nameIndex++;

                    $student = User::create([
                        'name' => $studentName,
                        'email' => $faker->unique()->safeEmail,
                        'password' => Hash::make('password'),
                        'role' => 'student',
                    ]);

                    // Profile
                    StudentProfile::create([
                        'user_id' => $student->id,
                        'phone' => '01'.$faker->numerify('#########'),
                        'district_id' => $center->district_id,
                        'upazila_id' => 1, // Fallback, could be random upazila
                        'dob' => $faker->date('Y-m-d', '2005-01-01'),
                        'gender' => $faker->randomElement(['male', 'female']),
                        'bio' => $faker->sentence,
                    ]);

                    // Give them exactly one course
                    $course = $courses->random();
                    Training::create([
                        'user_id' => $student->id,
                        'course_id' => $course->id,
                        'district_id' => $center->district_id,
                        'upazila_id' => 1,
                        'batch_id' => $batch->id,
                        'status' => 'completed',
                        'start_date' => $batch->start_date,
                        'end_date' => $batch->end_date,
                        'grade' => $faker->randomElement(['A+', 'A', 'B+', 'A-']),
                        'certificate_no' => uniqid(),
                    ]);

                    // Career (for roughly 90% of students)
                    if ($faker->boolean(90)) {
                        $status = $faker->randomElement(['job', 'freelance', 'entrepreneur', 'job_and_freelance', 'seeking', 'higher_education']);
                        $designation = $careerTitles[$faker->numberBetween(0, count($careerTitles) - 1)];

                        $careerData = [
                            'user_id' => $student->id,
                            'status' => $status,
                        ];

                        if (in_array($status, ['job', 'job_and_freelance'])) {
                            $careerData['income'] = $faker->numberBetween(15000, 60000);
                            $careerData['company'] = $faker->company;
                            $careerData['designation'] = $designation;
                            $careerData['join_date'] = $faker->date('Y-m-d', 'now');
                            $careerData['location'] = $faker->city;
                        }

                        if (in_array($status, ['freelance', 'job_and_freelance'])) {
                            $careerData['income'] = $careerData['income'] ?? $faker->numberBetween(20000, 80000);
                            $careerData['platform'] = $faker->randomElement(['Upwork', 'Fiverr', 'Freelancer']);
                            $careerData['profile_link'] = 'https://www.upwork.com/freelancers/~'.$faker->lexify('????????');
                            $careerData['completed_projects'] = $faker->numberBetween(5, 50);
                            $careerData['rating'] = $faker->randomFloat(1, 4.0, 5.0);
                        }

                        if ($status === 'entrepreneur') {
                            $careerData['income'] = $faker->numberBetween(50000, 150000);
                            $careerData['business_name'] = $faker->company;
                            $careerData['business_type'] = 'IT Services & E-commerce';
                            $careerData['employees'] = $faker->numberBetween(2, 20);
                            $careerData['business_website'] = 'https://www.'.$faker->domainName;
                        }

                        Career::create($careerData);
                    }
                }
            }
        }
    }
}
