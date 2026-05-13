<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Course;
use App\Models\Gallery;
use App\Models\ProjectOfficial;
use App\Models\Slider;
use App\Models\SuccessStory;
use App\Models\TrainingCenter;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'courses' => Course::count(),
            'centers' => TrainingCenter::count(),
            'success_stories' => SuccessStory::where('status', 'approved')->count(),
            'total_messages' => ContactMessage::count(),
            'new_messages' => ContactMessage::where('status', 'new')->count(),
            'gallery_items' => Gallery::count(),
            'sliders' => Slider::count(),
            'officials' => ProjectOfficial::count(),
        ];

        $recentStudents = User::where('role', 'student')
            ->with(['studentProfile', 'training.course'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentStudents'));
    }
}
