<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'student')
            ->with(['profile', 'training.course', 'training.center', 'career', 'portfolioSetting'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.students.index', compact('students'));
    }

    public function show(User $user)
    {
        $user->load(['profile', 'training.course', 'training.batch', 'training.center', 'career', 'projects', 'skills', 'socialLinks', 'portfolioSetting']);

        return view('admin.students.show', compact('user'));
    }

    public function edit(User $user)
    {
        $user->load(['profile', 'training', 'career', 'portfolioSetting']);

        return view('admin.students.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'nullable|string',
            'district' => 'nullable|string',
            'upazila' => 'nullable|string',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string',
            'bio' => 'nullable|string',
        ]);

        $user->update(['name' => $validated['name'], 'email' => $validated['email']]);

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'phone' => $validated['phone'],
                'district' => $validated['district'],
                'upazila' => $validated['upazila'],
                'dob' => $validated['dob'],
                'gender' => $validated['gender'],
                'bio' => $validated['bio'],
            ]
        );

        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
    }
}
