<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Http\Resources\GalleryResource;
use App\Http\Resources\PortfolioPublicResource;
use App\Http\Resources\SuccessStoryResource;
use App\Http\Resources\TrainingCenterResource;
use App\Models\Course;
use App\Models\Gallery;
use App\Models\PortfolioSetting;
use App\Models\SuccessStory;
use App\Models\Training;
use App\Models\TrainingCenter;
use App\Models\User;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Get all active courses.
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
     * Get all active training centers.
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
     * Get approved success stories.
     * Optional filter: district_id.
     */
    public function testimonials(Request $request)
    {
        $query = SuccessStory::with(['studentProfile.user', 'trainingCenter', 'career'])
            ->approved()
            ->orderBy('created_at', 'desc');

        // Optional filter: district_id
        if ($request->has('district_id')) {
            $query->whereHas('studentProfile', function ($q) use ($request) {
                $q->where('district_id', $request->district_id);
            });
        }

        // Optional search by name or skill
        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('studentProfile.user', function ($u) use ($request) {
                    $u->where('name', 'like', '%' . $request->search . '%');
                })->orWhereHas('career', function ($c) use ($request) {
                    $c->where('skill', 'like', '%' . $request->search . '%');
                });
            });
        }

        $successStories = $query->get();

        return response()->json([
            'success' => true,
            'data' => SuccessStoryResource::collection($successStories)->toArray($request),
        ]);
    }

    /**
     * Get active gallery images.
     */
    public function gallery(Request $request)
    {
        $images = Gallery::where('is_active', true)->orderBy('sort_order')->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => GalleryResource::collection($images)->toArray($request),
        ]);
    }

    /**
     * Get public portfolio by slug.
     */
    public function portfolio(Request $request, $slug)
    {
        $portfolio = PortfolioSetting::with(['user.profile', 'user.training.course', 'user.training.batch', 'user.training.center', 'user.career', 'user.projects', 'user.skills', 'user.socialLinks'])
            ->where('slug', $slug)
            ->first();

        if (! $portfolio || ! $portfolio->is_visible) {
            return response()->json([
                'success' => false,
                'message' => 'Portfolio not found or not publicly visible',
            ], 404);
        }

        $user = $portfolio->user;

        return response()->json([
            'success' => true,
            'data' => new PortfolioPublicResource($user),
        ]);
    }

    /**
     * Get project stats.
     */
    public function stats(Request $request)
    {
        // Basic stats from DB; can be expanded with caching
        $totalStudents = User::where('role', 'student')->count();
        $totalTrained = Training::count(); // approximate
        $totalCourses = Course::where('is_active', true)->count();
        $totalCenters = TrainingCenter::where('is_active', true)->count();

        // Calculate employment rate (students with career status not unemployed)
        $employedCount = Training::whereHas('user.career', function ($q) {
            $q->whereIn('status', ['job', 'freelance', 'entrepreneur', 'job_freelance']);
        })->count();

        $employmentRate = $totalTrained > 0 ? round(($employedCount / $totalTrained) * 100, 2) : 0;

        return response()->json([
            'success' => true,
            'data' => [
                'total_students_registered' => (int) $totalStudents,
                'total_students_trained' => (int) $totalTrained,
                'total_courses' => (int) $totalCourses,
                'total_centers' => (int) $totalCenters,
                'employment_rate' => (float) $employmentRate, // percentage
            ],
        ]);
    }

    /**
     * Get a single course by slug or id.
     */
    public function course(Request $request, $identifier)
    {
        $query = Course::where('is_active', true);
        if (is_numeric($identifier)) {
            $course = $query->find($identifier);
        } else {
            $course = $query->where('slug', $identifier)->first();
        }

        if (! $course) {
            return response()->json([
                'success' => false,
                'message' => 'Course not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new CourseResource($course),
        ]);
    }
}
