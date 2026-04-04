<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * List user's projects.
     */
    public function index(Request $request)
    {
        $projects = $request->user()->projects()->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => ProjectResource::collection($projects)->toArray($request),
        ]);
    }

    /**
     * Create a project.
     */
    public function store(ProjectRequest $request)
    {
        $user = $request->user();
        $project = $user->projects()->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Project added successfully',
            'data' => new ProjectResource($project),
        ], 201);
    }

    /**
     * Get single project.
     */
    public function show(Request $request, $id)
    {
        $project = $request->user()->projects()->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => new ProjectResource($project),
        ]);
    }

    /**
     * Update project.
     */
    public function update(ProjectRequest $request, $id)
    {
        $project = $request->user()->projects()->findOrFail($id);
        $project->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Project updated successfully',
            'data' => new ProjectResource($project),
        ]);
    }

    /**
     * Delete project.
     */
    public function destroy(Request $request, $id)
    {
        $project = $request->user()->projects()->findOrFail($id);
        $project->delete();

        return response()->json([
            'success' => true,
            'message' => 'Project deleted successfully',
        ]);
    }
}
