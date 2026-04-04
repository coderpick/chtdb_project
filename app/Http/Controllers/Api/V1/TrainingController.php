<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrainingRequest;
use App\Http\Resources\BatchResource;
use App\Http\Resources\CourseResource;
use App\Http\Resources\TrainingCenterResource;
use App\Http\Resources\TrainingResource;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Training;
use App\Models\TrainingCenter;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    /**
     * Get user's training record.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $training = $user->training()->with(['course', 'batch', 'center'])->first();

        return response()->json([
            'success' => true,
            'data' => $training ? new TrainingResource($training) : null,
        ]);
    }

    /**
     * Update training record.
     */
    public function update(TrainingRequest $request)
    {
        $user = $request->user();
        $training = $user->training()->firstOrCreate(['user_id' => $user->id]);

        $data = $request->validated();
        $training->update($data);

        $training->load(['course', 'batch', 'center']);

        return response()->json([
            'success' => true,
            'message' => 'Training information updated',
            'data' => new TrainingResource($training),
        ]);
    }

    /**
     * List all active courses for dropdown.
     */
    public function courses(Request $request)
    {
        $courses = Course::where('is_active', true)->orderBy('order')->orderBy('name')->get();

        return response()->json([
            'success' => true,
            'data' => CourseResource::collection($courses)->toArray($request),
        ]);
    }

    /**
     * List training centers.
     */
    public function centers(Request $request)
    {
        $centers = TrainingCenter::where('is_active', true)->get();

        return response()->json([
            'success' => true,
            'data' => TrainingCenterResource::collection($centers)->toArray($request),
        ]);
    }

    /**
     * List batches for a given course.
     */
    public function batches(Request $request, $courseId = null)
    {
        if ($courseId) {
            $batches = Batch::where('course_id', $courseId)->get();
        } else {
            $batches = Batch::all();
        }

        return response()->json([
            'success' => true,
            'data' => BatchResource::collection($batches)->toArray($request),
        ]);
    }
}
