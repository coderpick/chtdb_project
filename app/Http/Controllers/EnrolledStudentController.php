<?php

namespace App\Http\Controllers;

use App\Models\StudentRecord;

class EnrolledStudentController extends Controller
{
    public function index()
    {
        $students = StudentRecord::select('id', 'name', 'email', 'district_id', 'batch_id', 'freelancer_profile_url')
            ->with(['district', 'batch'])
            ->get();

        // Normalize freelancer profile URLs
        $students->transform(function ($student) {
            if ($student->freelancer_profile_url) {
                $url = trim($student->freelancer_profile_url);
                if (!empty($url)) {
                    // Remove any accidental spaces
                    $url = str_replace(' ', '', $url);
                    // Ensure it starts with https:// or http://
                    if (!preg_match('/^https?:\/\//i', $url)) {
                        $url = 'https://' . ltrim($url, '/');
                    }
                    $student->freelancer_profile_url = $url;
                }
            }
            return $student;
        });

        return view('student_directory.index', compact('students'));
    }
}
