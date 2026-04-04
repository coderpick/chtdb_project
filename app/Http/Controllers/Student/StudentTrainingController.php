<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Course;
use App\Models\TrainingCenter;
use Illuminate\Http\Request;

class StudentTrainingController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        $user->load(['training.course', 'training.batch', 'training.center']);

        $courses = Course::where('is_active', true)->orderBy('order')->get();
        $batches = Batch::with('course')->orderBy('start_date', 'desc')->get();
        $centers = TrainingCenter::where('is_active', true)->get();

        return view('student.training.edit', compact('user', 'courses', 'batches', 'centers'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'batch_id' => 'nullable|exists:batches,id',
            'center_id' => 'required|exists:training_centers,id',
            'status' => 'required|in:ongoing,completed,certified',
            'grade' => 'nullable|string|max:10',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $user->training()->update($validated);

        return back()->with('success', 'Training information updated.');
    }
}
