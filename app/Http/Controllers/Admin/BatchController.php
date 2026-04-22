<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\TrainingCenter;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $batches = Batch::with('center')->get();

        return view('admin.batch.index', compact('batches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $centers = TrainingCenter::all();

        return view('admin.batch.create', compact('centers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'training_center_id' => 'required|exists:training_centers,id',
            'shift' => 'required|in:Morning,Afternoon',
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'capacity' => 'required|integer|min:1',
            'enrolled_count' => 'required|integer|min:0',
            'status' => 'required|in:upcoming,ongoing,completed',
        ]);

        Batch::create([
            'training_center_id' => $request->training_center_id,
            'shift' => $request->shift,
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'capacity' => $request->capacity,
            'enrolled_count' => $request->enrolled_count,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.batch.index')->with('success', 'Batch created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $batch = Batch::findOrFail($id);
        $centers = TrainingCenter::all();

        return view('admin.batch.edit', compact('batch', 'centers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $batch = Batch::with('center')->findOrFail($id);
        $centers = TrainingCenter::all();

        return view('admin.batch.edit', compact('batch', 'centers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $batch = Batch::findOrFail($id);

        $request->validate([
            'training_center_id' => 'required|exists:training_centers,id',
            'shift' => 'required|in:Morning,Afternoon',
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'capacity' => 'required|integer|min:1',
            'enrolled_count' => 'required|integer|min:0',
            'status' => 'required|in:upcoming,ongoing,completed',
        ]);

        $batch->update($request->all());

        return redirect()->route('admin.batch.index')->with('success', 'Batch updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $batch = Batch::findOrFail($id);
        $batch->delete();

        return redirect()->route('admin.batch.index')->with('success', 'Batch deleted successfully.');
    }
}
