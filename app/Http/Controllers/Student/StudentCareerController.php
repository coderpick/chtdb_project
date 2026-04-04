<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentCareerController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        $user->load('career');

        return view('student.career.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:job,freelance,entrepreneur,job_and_freelance,seeking,higher_education',
            'designation' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'income' => 'nullable|numeric|min:0',
            'join_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'platform' => 'nullable|string|max:255',
            'profile_link' => 'nullable|url|max:500',
            'completed_projects' => 'nullable|integer|min:0',
            'rating' => 'nullable|string|max:10',
            'business_name' => 'nullable|string|max:255',
            'business_type' => 'nullable|string|max:255',
            'employees' => 'nullable|integer|min:0',
            'business_website' => 'nullable|url|max:500',
            'story' => 'nullable|string',
        ]);

        $user = auth()->user();

        // If career record doesn't exist, create it
        if (! $user->career) {
            $user->career()->create($validated);
        } else {
            $user->career()->update($validated);
        }

        return back()->with('success', 'Career information updated.');
    }
}
