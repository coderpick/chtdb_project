<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Course;
use App\Models\District;
use App\Models\Training;
use App\Models\TrainingCenter;
use App\Models\Upazila;
use Illuminate\Http\Request;

class StudentTrainingController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $training = Training::where('user_id', $user->id)->with('course', 'batch', 'district', 'upazila')->first();
        $courses = Course::where('is_active', true)->orderBy('order')->get();
        $batches = Batch::where('id', $training->batch_id)->get();
        $centers = TrainingCenter::where('is_active', true)->with('district')->get();
        $districts = District::all();
        $upazilas = Upazila::where('district_id', $training->district_id)->get();

        return view('student.training.index', compact('user', 'training', 'courses', 'batches', 'centers', 'districts', 'upazilas'));
    }

    public function update(Request $request)
    {

        $user = auth()->user();

        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'batch_id' => 'nullable|exists:batches,id',
            'center_id' => 'required|exists:training_centers,id',
            'status' => 'required|in:ongoing,completed,certified',
            'district_id' => 'required|exists:districts,id',
            'upazila_id' => 'required|exists:upazilas,id',
            'grade' => 'nullable|string|max:10',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        if (! $user->training) {
            $user->training()->create([
                'user_id' => $user->id,
                'batch_id' => $validated['batch_id'],
                'course_id' => $validated['course_id'],
                'district_id' => $validated['district_id'],
                'upazila_id' => $validated['upazila_id'],
                'status' => $validated['status'],
                'grade' => $validated['grade'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
            ]);
        } else {
            $user->training()->update([
                'user_id' => $user->id,
                'batch_id' => $validated['batch_id'],
                'course_id' => $validated['course_id'],
                'district_id' => $validated['district_id'],
                'upazila_id' => $validated['upazila_id'],
                'status' => $validated['status'],
                'grade' => $validated['grade'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
            ]);
        }

        return back()->with('success', 'Training information updated.');
    }
}
