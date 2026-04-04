<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class StudentProjectController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        $user = auth()->user();
        $projects = $user->projects()->orderBy('is_featured', 'desc')->orderBy('created_at', 'desc')->get();

        return view('student.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('student.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'technologies' => 'nullable|string',
            'project_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'image' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
        ]);

        $user = auth()->user();

        $data = [
            'name' => $validated['title'],
            'description' => $validated['description'],
            'technologies' => $validated['technologies'] ?? '',
            'link' => $validated['project_url'] ?? null,
            'github' => $validated['github_url'] ?? null,
            'is_featured' => $request->has('is_featured'),
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $this->fileUpload($request->file('image'), 'uploads/student/project');
        }

        $user->projects()->create($data);

        return redirect()->route('student.projects.index')->with('success', 'Project added.');
    }

    public function edit($id)
    {
        $user = auth()->user();
        $project = $user->projects()->findOrFail($id);

        // Map DB fields to form fields
        $project->title = $project->name;
        $project->project_url = $project->link;
        $project->github_url = $project->github;

        return view('student.projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $project = $user->projects()->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'technologies' => 'nullable|string',
            'project_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'image' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
        ]);

        $data = [
            'name' => $validated['title'],
            'description' => $validated['description'],
            'technologies' => $validated['technologies'] ?? '',
            'link' => $validated['project_url'] ?? null,
            'github' => $validated['github_url'] ?? null,
            'is_featured' => $request->has('is_featured'),
        ];

        if ($request->hasFile('image')) {
            if ($project->image) {
                $data['image'] = $this->fileUpload($request->file('image'), 'uploads/student/project', $project->image);
            }
        }

        $project->update($data);

        return redirect()->route('student.projects.index')->with('success', 'Project updated.');
    }

    public function destroy($id)
    {
        $user = auth()->user();
        $project = $user->projects()->findOrFail($id);

        if ($project->image) {
            $this->unlink($project->image);
        }

        $project->delete();

        return back()->with('success', 'Project deleted.');
    }
}
