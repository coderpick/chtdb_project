<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Testimonial;
use App\Models\TrainingCenter;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'students' => User::where('role', 'student')->count(),
            'courses' => Course::count(),
            'centers' => TrainingCenter::count(),
            'testimonials' => Testimonial::where('status', 'approved')->count(),
        ];

        $recentStudents = User::where('role', 'student')
            ->with(['profile', 'training.course'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentStudents'));
    }
}
