<?php

namespace App\Http\Controllers\Admin;
 
use App\Http\Controllers\Controller;
use App\Models\ProjectOfficial;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class ProjectOfficialController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        $officials = ProjectOfficial::orderBy('order')->get();
        return view('admin.officials.index', compact('officials'));
    }

    public function create()
    {
        return view('admin.officials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'organization' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'facebook_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'email' => 'nullable|email',
            'order' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->fileUpload($request->file('image'), 'uploads/officials');
        }

        $validated['order'] = $request->integer('order', 0);
        $validated['status'] = $request->boolean('status', true);

        ProjectOfficial::create($validated);

        return redirect()->route('admin.officials.index')->with('success', 'Official added successfully.');
    }

    public function edit(ProjectOfficial $official)
    {
        return view('admin.officials.edit', compact('official'));
    }

    public function update(Request $request, ProjectOfficial $official)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'organization' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'facebook_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'email' => 'nullable|email',
            'order' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->fileUpload($request->file('image'), 'uploads/officials', $official->image);
        }

        $validated['order'] = $request->integer('order', $official->order);
        $validated['status'] = $request->boolean('status', $official->status);

        $official->update($validated);

        return redirect()->route('admin.officials.index')->with('success', 'Official updated successfully.');
    }

    public function destroy(ProjectOfficial $official)
    {
        if ($official->image) {
            $this->unlink($official->image);
        }
        $official->delete();

        return redirect()->route('admin.officials.index')->with('success', 'Official deleted successfully.');
    }
}
