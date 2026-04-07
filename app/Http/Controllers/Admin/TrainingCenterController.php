<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrainingCenter;
use Illuminate\Http\Request;

class TrainingCenterController extends Controller
{
    public function index()
    {
        $centers = TrainingCenter::get();

        return view('admin.centers.index', compact('centers'));
    }

    public function create()
    {
        return view('admin.centers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'district_id' => 'required|exists:districts,id',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        TrainingCenter::create($validated);

        return redirect()->route('admin.centers.index')->with('success', 'Training center created successfully.');
    }

    public function edit(TrainingCenter $center)
    {
        return view('admin.centers.edit', compact('center'));
    }

    public function update(Request $request, TrainingCenter $center)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'district_id' => 'required|exists:districts,id',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        $center->update($validated);

        return redirect()->route('admin.centers.index')->with('success', 'Training center updated successfully.');
    }

    public function destroy(TrainingCenter $center)
    {
        $center->delete();

        return redirect()->route('admin.centers.index')->with('success', 'Training center deleted successfully.');
    }
}
