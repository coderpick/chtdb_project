<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Gallery;
use App\Models\Testimonial;
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
            'students' => User::where('role', 'student')->count(),
            'courses' => Course::count(),
            'centers' => TrainingCenter::count(),
            'testimonials' => Testimonial::where('status', 'approved')->count(),
            'districts' => 3, // Fixed for three hill districts
            'employment_rate' => 92, // Static as per design
        ];

        $courses = Course::orderBy('order')->get();

        $testimonials = Testimonial::with('course')
            ->where('status', 'approved')
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $gallery = Gallery::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $centers = TrainingCenter::all();

        return view('welcome', compact('stats', 'courses', 'testimonials', 'gallery', 'centers'));
    }
}
