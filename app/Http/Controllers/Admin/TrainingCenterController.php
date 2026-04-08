<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\TrainingCenter;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class TrainingCenterController extends Controller
{
    use FileUploadTrait;
    public function index()
    {
        $centers = TrainingCenter::get();

        return view('admin.centers.index', compact('centers'));
    }

    public function create()
    {
        $districts = District::all();

        return view('admin.centers.create', compact('districts'));
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
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('banner')) {
            $validated['banner'] = $this->fileUpload($request->file('banner'), 'uploads/centers');
        }

        $validated['is_active'] = $request->boolean('is_active', true);

        TrainingCenter::create($validated);

        return redirect()->route('admin.centers.index')->with('success', 'Training center created successfully.');
    }

    public function edit(TrainingCenter $center)
    {
        $districts = District::all();

        return view('admin.centers.edit', compact('center', 'districts'));
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
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('banner')) {
            $validated['banner'] = $this->fileUpload($request->file('banner'), 'uploads/centers', $center->banner);
        }

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
