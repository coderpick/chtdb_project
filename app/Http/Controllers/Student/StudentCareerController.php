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
            'status' => 'required|in:job,freelance,entrepreneur',
            'designation' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'income' => 'nullable|numeric|min:0',
            'join_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
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
