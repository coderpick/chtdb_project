<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\StudentRecord;

use Illuminate\Http\Request;

class EnrolledStudentController extends Controller
{
    public function index(Request $request)
    {
        $districts = District::all();
        $perPage = $request->input('per_page', 15);

        $query = StudentRecord::query()
            ->select('id', 'name', 'email', 'district_id', 'batch_id', 'freelancer_profile_url')
            ->with(['district', 'batch']);

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('district')) {
            $query->where('district_id', $request->district);
        }

        $students = $query->paginate($perPage)->withQueryString();

        // Normalize freelancer profile URLs
        $students->getCollection()->transform(function ($student) {
            if ($student->freelancer_profile_url) {
                $url = trim($student->freelancer_profile_url);
                if (! empty($url)) {
                    // Remove any accidental spaces
                    $url = str_replace(' ', '', $url);
                    // Ensure it starts with https:// or http://
                    if (! preg_match('/^https?:\/\//i', $url)) {
                        $url = 'https://' . ltrim($url, '/');
                    }
                    $student->freelancer_profile_url = $url;
                }
            }

            return $student;
        });

        if ($request->ajax()) {
            return view('student_directory._table', compact('students'))->render();
        }

        return view('student_directory.index', compact('students', 'districts'));
    }
}
