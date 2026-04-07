<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\District;
use App\Models\Gallery;
use App\Models\SuccessStory;
use App\Models\TrainingCenter;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Display the landing page.
     */
    public function index()
    {
        $stats = [
            // 'students' => User::where('role', 'student')->count(),
            'students' => 200,
            'courses' => Course::count(),
            'centers' => TrainingCenter::count(),
            'success_stories' => SuccessStory::where('status', 'approved')->count(),
            'districts' => 3, // Fixed for three hill districts
            'employment_rate' => 85, // Static as per design
        ];

        $courses = Course::orderBy('order')->get();
        $districts = District::all();
        $successStories = SuccessStory::with(['user.studentProfile', 'user.training.course', 'career', 'district'])
            ->approved()
            ->orderBy('created_at', 'desc')
            ->get();

        $gallery = Gallery::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $centers = TrainingCenter::all();

        return view('welcome', compact('stats', 'courses', 'successStories', 'gallery', 'centers', 'districts'));
    }
}
