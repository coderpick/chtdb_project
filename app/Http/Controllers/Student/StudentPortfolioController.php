<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\PortfolioSetting;
use Illuminate\Http\Request;

class StudentPortfolioController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        $user->load('portfolioSetting');

        $portfolio = $user->portfolioSetting ?? new PortfolioSetting;

        $stats = [
            'projects' => $user->projects()->count(),
            'skills' => $user->skills->pluck('name')->join(', '),
            'course' => $user->training->course->name ?? 'Course Not Assigned',
            'district' => $user->profile->district->name ?? 'CHT',
        ];

        return view('student.portfolio.edit', compact('portfolio', 'stats'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'slug' => 'required|alpha_dash|unique:portfolio_settings,slug,'.($user->portfolioSetting->id ?? 0),
            'tagline' => 'nullable|string|max:255',
            'theme' => 'nullable|in:green,blue,purple,orange,dark,teal',
        ]);

        $validated['is_visible'] = $request->has('is_visible');

        if (! $user->portfolioSetting) {
            $user->portfolioSetting()->create($validated);
        } else {
            $user->portfolioSetting()->update($validated);
        }

        return back()->with('success', 'Portfolio settings updated.');
    }
}
