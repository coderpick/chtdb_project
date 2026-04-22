<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\District;
use App\Models\StudentRecord;
use Illuminate\Http\Request;

class StudentRecordController extends Controller
{
    public function index(Request $request)
    {
        $query = StudentRecord::with(['district', 'upazila', 'batch']);

        // Filtering
        if ($request->filled('name')) {
            $query->where('name', 'like', '%'.$request->name.'%');
        }

        if ($request->filled('district_id')) {
            $query->where('district_id', $request->district_id);
        }

        if ($request->filled('batch_id')) {
            $query->where('batch_id', $request->batch_id);
        }

        $students = $query->latest()->paginate(20)->withQueryString();

        $districts = District::orderBy('name')->get();

        if ($request->ajax()) {
            return response()->json($students);
        }

        return view('admin.student_record.index', compact('students', 'districts'));
    }

    public function show($id)
    {
        $student = StudentRecord::with(['district', 'upazila', 'batch'])->find($id);

        return view('admin.student_record.show', compact('student'));
    }

    public function edit($id)
    {
        $student = StudentRecord::with(['district', 'upazila', 'batch'])->find($id);
        $districts = District::orderBy('name')->get();
        $batches = Batch::orderBy('name')->get();

        return view('admin.student_record.edit', compact('student', 'districts', 'batches'));
    }

    public function update(Request $request, $id)
    {
        $student = StudentRecord::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:student_records,email,'.$id,
            'district_id' => 'required|exists:districts,id',
            'upazila_id' => 'required|exists:upazilas,id',
            'batch_id' => 'required|exists:batches,id',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'academic_qualification' => 'nullable|string|max:255',
            'income_source' => 'nullable|string|max:255',
            'freelancer_profile_url' => 'nullable|url|max:255',
            'address' => 'nullable|string|max:1000',
        ]);

        $student->update($validatedData);

        return redirect()->route('admin.student_record')->with('success', 'Student updated successfully!');
    }
}
