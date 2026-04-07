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
            'studentProfile.district',
            'training.course',
            'training.batch',         
            'career',
            'projects',
            'skills',
            'socialLinks',
            'portfolioSetting',
        ]);

        return view('student.dashboard', compact('user'));
    }
}
