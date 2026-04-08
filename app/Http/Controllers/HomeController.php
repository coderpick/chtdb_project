<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\District;
use App\Models\Gallery;
use App\Models\SuccessStory;
use App\Models\TrainingCenter;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Display the landing page.
     */
    public function index()
    {
        $studentCount = User::where('role', 'student')->count() ?: 200;

        $stats = [
            'students' => \App\Models\Setting::get('hero_stat_1_value', $studentCount),
            'courses' => \App\Models\Setting::get('hero_stat_3_value', Course::count() ?: 8),
            'centers' => TrainingCenter::count(),
            'success_stories' => SuccessStory::where('status', 'approved')->count(),
            'districts' => \App\Models\Setting::get('hero_stat_2_value', 3),
            'employment_rate' => \App\Models\Setting::get('hero_stat_4_value', 85),
            
            // Extra Statistics Section Values
            'extra_1_value' => \App\Models\Setting::get('stats_extra_1_value', $studentCount),
            'extra_2_value' => \App\Models\Setting::get('stats_extra_2_value', round($studentCount * 0.92)),
            'extra_3_value' => \App\Models\Setting::get('stats_extra_3_value', round($studentCount * 0.2)),
            'extra_4_value' => \App\Models\Setting::get('stats_extra_4_value', round($studentCount * 0.15)),
        ];

        $courses = Course::orderBy('order')->get();
        $districts = District::all();
        $successStories = SuccessStory::with(['user.studentProfile', 'user.training.course', 'career'])
            ->approved()
            ->orderBy('created_at', 'desc')
            ->get();

        $gallery = Gallery::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $centers = TrainingCenter::all();

        // Optimize duplicated district queries by manually associating the loaded collection
        $successStories->each(function ($story) use ($districts) {
            $story->setRelation('district', $districts->find($story->district_id));
        });
        $centers->each(function ($center) use ($districts) {
            $center->setRelation('district', $districts->find($center->district_id));
        });

        return view('welcome', compact('stats', 'courses', 'successStories', 'gallery', 'centers', 'districts'));
    }
}
