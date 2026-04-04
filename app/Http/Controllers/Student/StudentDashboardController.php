<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Eager load all relationships for dashboard
        $user->load([
            'profile',
            'training.course',
            'training.batch',
            'training.center',
            'career',
            'projects',
            'skills',
            'socialLinks',
            'portfolioSetting',
        ]);

        return view('student.dashboard', compact('user'));
    }
}
