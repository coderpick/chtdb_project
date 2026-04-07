<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\District;
use App\Models\Upazila;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'student')
            ->with(['studentProfile.district', 'studentProfile.upazila', 'training.course', 'career', 'portfolioSetting']);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('email', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->filled('district_id')) {
            $query->whereHas('studentProfile', function ($q) use ($request) {
                $q->where('district_id', $request->district_id);
            });
        }

        if ($request->filled('upazila_id')) {
            $query->whereHas('studentProfile', function ($q) use ($request) {
                $q->where('upazila_id', $request->upazila_id);
            });
        }

        if ($request->filled('course_id')) {
            $query->whereHas('training', function ($q) use ($request) {
                $q->where('course_id', $request->course_id);
            });
        }

        $students = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();
        $districts = District::all();
        $courses = Course::where('is_active', true)->get();

        return view('admin.students.index', compact('students', 'districts', 'courses'));
    }

    public function show(User $user)
    {
        $user->load(['studentProfile.district', 'studentProfile.upazila', 'training.course', 'training.batch',  'career', 'projects', 'skills', 'socialLinks', 'portfolioSetting']);

        return view('admin.students.show', compact('user'));
    }

    public function edit(User $user)
    {
        $user->load(['studentProfile', 'training', 'career', 'portfolioSetting']);
        $districts = District::all();
        $upazilas = $user->studentProfile && $user->studentProfile->district_id
            ? Upazila::where('district_id', $user->studentProfile->district_id)->get()
            : collect();

        return view('admin.students.edit', compact('user', 'districts', 'upazilas'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'nullable|string',
            'district_id' => 'required|exists:districts,id',
            'upazila_id' => 'required|exists:upazilas,id',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'bio' => 'nullable|string',
        ]);

        $user->update(['name' => $validated['name'], 'email' => $validated['email']]);

        $user->studentProfile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'phone' => $validated['phone'],
                'district_id' => $validated['district_id'] ?? null,
                'upazila_id' => $validated['upazila_id'] ?? null,
                'dob' => $validated['dob'],
                'gender' => $validated['gender'],
                'bio' => $validated['bio'],
            ]
        );

        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
    }
}
