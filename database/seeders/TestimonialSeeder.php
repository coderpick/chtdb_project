<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing testimonials to avoid duplicates if re-running
        Testimonial::truncate();

        $courses = Course::all()->pluck('id', 'slug')->toArray();

        $stories = [
            [
                'name' => 'মং সাই মারমা',
                'district' => 'rangamati',
                'course_slug' => 'web-development',
                'content' => 'রাঙামাটির প্রত্যন্ত অঞ্চল থেকে এসে PeopleNTech এর ওয়েব ডেভেলপমেন্ট কোর্সে প্রশিক্ষণ নিয়ে এখন সফলভাবে ফ্রিল্যান্সিং করছি। Upwork ও Fiverr এ নিয়মিত কাজ পাচ্ছি। প্রতি মাসে ভালো আয় হচ্ছে।',
                'photo' => 'https://randomuser.me/api/portraits/men/32.jpg',
                'job_title' => 'ফ্রিল্যান্সার',
                'title' => 'ওয়েব ডেভেলপমেন্ট',
                'is_featured' => true,
                'status' => 'approved',
            ],
            [
                'name' => 'প্রিয়াংকা চাকমা',
                'district' => 'khagrachhari',
                'course_slug' => 'graphic-design',
                'content' => 'গ্রাফিক ডিজাইন কোর্সটি আমার জীবন বদলে দিয়েছে। PeopleNTech এর অভিজ্ঞ মেন্টরদের সহায়তায় এখন আমি একটি স্থানীয় প্রতিষ্ঠানে ডিজাইনার হিসেবে কাজ করছি। আমার পরিবারের আর্থিক অবস্থার উন্নতি হয়েছে।',
                'photo' => 'https://randomuser.me/api/portraits/women/44.jpg',
                'job_title' => 'চাকরিজীবী',
                'title' => 'গ্রাফিক ডিজাইন',
                'is_featured' => true,
                'status' => 'approved',
            ],
            [
                'name' => 'উ চিং মং মারমা',
                'district' => 'bandarban',
                'course_slug' => 'mobile-app-development',
                'content' => 'বান্দরবানের দুর্গম পাহাড়ি এলাকা থেকে এসে মোবাইল অ্যাপ ডেভেলপমেন্ট শিখেছি। এখন ঢাকার একটি সফটওয়্যার কোম্পানিতে জুনিয়র ডেভেলপার হিসেবে কাজ করছি। স্বপ্ন ছিল প্রোগ্রামার হওয়ার — সেটা এখন বাস্তব।',
                'photo' => 'https://randomuser.me/api/portraits/men/67.jpg',
                'job_title' => 'সফটওয়্যার ডেভ',
                'title' => 'মোবাইল অ্যাপ ডেভেলপমেন্ট',
                'is_featured' => true,
                'status' => 'approved',
            ],
            [
                'name' => 'কল্পনা ত্রিপুরা',
                'district' => 'rangamati',
                'course_slug' => 'digital-marketing',
                'content' => 'ডিজিটাল মার্কেটিং কোর্সের মাধ্যমে সোশ্যাল মিডিয়া মার্কেটিং, SEO ও কন্টেন্ট মার্কেটিং শিখেছি। এখন নিজের একটি ডিজিটাল মার্কেটিং এজেন্সি চালাচ্ছি। ৫ জনকে কাজ দিতে পারছি।',
                'photo' => 'https://randomuser.me/api/portraits/women/68.jpg',
                'job_title' => 'উদ্যোক্তা',
                'title' => 'ডিজিটাল মার্কেটিং',
                'is_featured' => true,
                'status' => 'approved',
            ],
            [
                'name' => 'সুমিত চাকমা',
                'district' => 'khagrachhari',
                'course_slug' => 'database-management',
                'content' => 'ডেটাবেজ ম্যানেজমেন্ট কোর্স করে এখন একটি ব্যাংকে ডেটাবেজ অ্যাডমিনিস্ট্রেটর হিসেবে কাজ করছি। PeopleNTech এর জব প্লেসমেন্ট সাপোর্ট আমার চাকরি পেতে সাহায্য করেছে। পরিবারকে financially সাহায্য করতে পারছি।',
                'photo' => 'https://randomuser.me/api/portraits/men/45.jpg',
                'job_title' => 'চাকরিজীবী',
                'title' => 'ডেটাবেজ ম্যানেজমেন্ট',
                'is_featured' => true,
                'status' => 'approved',
            ],
            [
                'name' => 'মেনুকা তঞ্চঙ্গ্যা',
                'district' => 'bandarban',
                'course_slug' => 'e-commerce',
                'content' => 'ই-কমার্স কোর্সের মাধ্যমে অনলাইন ব্যবসা পরিচালনা শিখেছি। এখন পাহাড়ি হস্তশিল্প অনলাইনে বিক্রি করছি। স্থানীয় নারীদেরও কর্মসংস্থানের ব্যবস্থা হয়েছে।',
                'photo' => 'https://randomuser.me/api/portraits/women/55.jpg',
                'job_title' => 'উদ্যোক্তা',
                'title' => 'ই-কমার্স',
                'is_featured' => true,
                'status' => 'approved',
            ],
            [
                'name' => 'রাজীব তালুকদার',
                'district' => 'rangamati',
                'course_slug' => 'cyber-security',
                'content' => 'সাইবার সিকিউরিটি কোর্সটি আমাকে একজন দক্ষ সিকিউরিটি অ্যানালিস্ট হিসেবে গড়ে তুলেছে। এখন একটি আইটি ফার্মে কাজ করছি। পার্বত্য অঞ্চল থেকে এসেও দেশের শীর্ষ কোম্পানিতে কাজ করার সুযোগ পেয়েছি।',
                'photo' => 'https://randomuser.me/api/portraits/men/22.jpg',
                'job_title' => 'চাকরিজীবী',
                'title' => 'সাইবার সিকিউরিটি',
                'is_featured' => true,
                'status' => 'approved',
            ],
            [
                'name' => 'সুষমা দেওয়ান',
                'district' => 'khagrachhari',
                'course_slug' => 'video-editing',
                'content' => 'ভিডিও এডিটিং কোর্সটি আমার সৃজনশীলতাকে পেশায় রূপান্তরিত করেছে। এখন YouTube এ কন্টেন্ট তৈরি করি এবং বিভিন্ন প্রতিষ্ঠানের জন্য ভিডিও এডিটিং করি। ফ্রিল্যান্সিং করে প্রতি মাসে ভালো আয় করছি।',
                'photo' => 'https://randomuser.me/api/portraits/women/33.jpg',
                'job_title' => 'ফ্রিল্যান্সার',
                'title' => 'ভিডিও এডিটিং',
                'is_featured' => true,
                'status' => 'approved',
            ],
            [
                'name' => 'অং থুই প্রু মারমা',
                'district' => 'bandarban',
                'course_slug' => 'web-development',
                'content' => 'PeopleNTech এর ওয়েব ডেভেলপমেন্ট কোর্সে React ও Node.js শিখেছি। এখন ঢাকায় একটি স্টার্টআপে ফুলস্ট্যাক ডেভেলপার হিসেবে কাজ করছি। বান্দরবান থেকে এসে এই সাফল্য আমার জন্য গর্বের বিষয়।',
                'photo' => 'https://randomuser.me/api/portraits/men/52.jpg',
                'job_title' => 'সফটওয়্যার ডেভ',
                'title' => 'ওয়েব ডেভেলপমেন্ট',
                'is_featured' => true,
                'status' => 'approved',
            ],
            [
                'name' => 'রূপালী চাকমা',
                'district' => 'rangamati',
                'course_slug' => 'graphic-design',
                'content' => 'UI/UX ডিজাইন শিখে এখন ফ্রিল্যান্সিং এ ক্যারিয়ার গড়ছি। আন্তর্জাতিক ক্লায়েন্টদের সাথে কাজ করছি। PeopleNTech এর মেন্টরশিপ আমাকে আত্মবিশ্বাসী করেছে।',
                'photo' => 'https://randomuser.me/api/portraits/women/22.jpg',
                'job_title' => 'ফ্রিল্যান্সার',
                'title' => 'UI/UX ডিজাইন',
                'is_featured' => true,
                'status' => 'approved',
            ],
            [
                'name' => 'বিমল কান্তি চাকমা',
                'district' => 'khagrachhari',
                'course_slug' => 'digital-marketing',
                'content' => 'ডিজিটাল মার্কেটিং শিখে এখন স্থানীয় ব্যবসায়ীদের অনলাইন মার্কেটিং এ সাহায্য করছি। নিজের এজেন্সি খুলে ৩ জনকে কর্মসংস্থান দিয়েছি।',
                'photo' => 'https://randomuser.me/api/portraits/men/77.jpg',
                'job_title' => 'উদ্যোক্তা',
                'title' => 'ডিজিটাল মার্কেটিং',
                'is_featured' => true,
                'status' => 'approved',
            ],
            [
                'name' => 'ক্লোইং মারমা',
                'district' => 'bandarban',
                'course_slug' => 'mobile-app-development',
                'content' => 'Flutter দিয়ে মোবাইল অ্যাপ তৈরি শিখে এখন ফ্রিল্যান্সিং করছি। স্থানীয় ব্যবসার জন্য অ্যাপ তৈরি করে আয় করছি। পাহাড়ের মেয়ে হয়ে এখন প্রযুক্তিবিদ — এটাই আমার সবচেয়ে বড় অর্জন।',
                'photo' => 'https://randomuser.me/api/portraits/women/77.jpg',
                'job_title' => 'ফ্রিল্যান্সার',
                'title' => 'মোবাইল অ্যাপ ডেভেলপমেন্ট',
                'is_featured' => true,
                'status' => 'approved',
            ],
        ];

        foreach ($stories as $story) {
            Testimonial::create([
                'name' => $story['name'],
                'district' => $story['district'],
                'course_id' => $courses[$story['course_slug']] ?? null,
                'title' => $story['title'],
                'content' => $story['content'],
                'photo' => $story['photo'],
                'job_title' => $story['job_title'],
                'is_featured' => $story['is_featured'],
                'status' => $story['status'],
            ]);
        }

        // Additional simple testimonials (non-featured)
        $simpleTestimonials = [
            [
                'name' => 'সুমন দেওয়ান',
                'district' => 'rangamati',
                'title' => 'শিক্ষার্থী মতামত',
                'content' => 'পাহাড়ের দুর্গম এলাকায় বসে আন্তর্জাতিক মানের আইটি প্রশিক্ষণ পাওয়া সত্যিই অসাধারণ অভিজ্ঞতা। কোর্স শেষে জব প্লেসমেন্ট সাপোর্ট এবং ফ্রিল্যান্সিং গাইডেন্স পেয়েছি।',
                'photo' => 'https://randomuser.me/api/portraits/men/11.jpg',
                'job_title' => 'শিক্ষার্থী',
                'is_featured' => false,
                'status' => 'approved',
            ],
            [
                'name' => 'রিনা চাকমা',
                'district' => 'khagrachhari',
                'title' => 'শিক্ষার্থী মতামত',
                'content' => 'প্রশিক্ষকরা খুবই ধৈর্যশীল ও সহযোগী ছিলেন। অনেক কিছু শিখতে পেরেছি। ধন্যবাদ CHTDB ও PeopleNTech!',
                'photo' => 'https://randomuser.me/api/portraits/women/12.jpg',
                'job_title' => 'শিক্ষার্থী',
                'is_featured' => false,
                'status' => 'approved',
            ],
            [
                'name' => 'অং মারমা',
                'district' => 'bandarban',
                'title' => 'শিক্ষার্থী মতামত',
                'content' => 'এই কোর্সটি আমার জীবনের নতুন দিগন্ত উন্মোচন করেছে। এখন আমি আত্মবিশ্বাসী।',
                'photo' => 'https://randomuser.me/api/portraits/men/13.jpg',
                'job_title' => 'শিক্ষার্থী',
                'is_featured' => false,
                'status' => 'approved',
            ],
            [
                'name' => 'মায়া ত্রিপুরা',
                'district' => 'rangamati',
                'title' => 'শিক্ষার্থী মতামত',
                'content' => 'খুবই ভালো একটি উদ্যোগ। অনেক কিছু শিখলাম।',
                'photo' => 'https://randomuser.me/api/portraits/women/14.jpg',
                'job_title' => 'শিক্ষার্থী',
                'is_featured' => false,
                'status' => 'approved',
            ],
            [
                'name' => 'জীবন চাকমা',
                'district' => 'khagrachhari',
                'title' => 'শিক্ষার্থী মতামত',
                'content' => 'প্র্যাকটিক্যাল ক্লাসগুলো অনেক ভালো লেগেছে।',
                'photo' => 'https://randomuser.me/api/portraits/men/15.jpg',
                'job_title' => 'শিক্ষার্থী',
                'is_featured' => false,
                'status' => 'approved',
            ],
            [
                'name' => 'থুই মারমা',
                'district' => 'bandarban',
                'title' => 'শিক্ষার্থী মতামত',
                'content' => 'লাইভ প্রজেক্টে কাজ করে অনেক অভিজ্ঞতা হলো।',
                'photo' => 'https://randomuser.me/api/portraits/men/16.jpg',
                'job_title' => 'শিক্ষার্থী',
                'is_featured' => false,
                'status' => 'approved',
            ],
            [
                'name' => 'সোনিয়া চাকমা',
                'district' => 'rangamati',
                'title' => 'শিক্ষার্থী মতামত',
                'content' => 'ধন্যবাদ এ সুযোগ দেওয়ার জন্য।',
                'photo' => 'https://randomuser.me/api/portraits/women/17.jpg',
                'job_title' => 'শিক্ষার্থী',
                'is_featured' => false,
                'status' => 'approved',
            ],
        ];

        foreach ($simpleTestimonials as $t) {
            Testimonial::create($t);
        }
    }
}
