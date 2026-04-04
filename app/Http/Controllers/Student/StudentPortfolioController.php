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

        return view('student.portfolio.edit', compact('portfolio'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'slug' => 'required|alpha_dash|unique:portfolio_settings,slug,'.($user->portfolioSetting->id ?? 0).',id,user_id,'.$user->id,
            'tagline' => 'nullable|string|max:255',
            'theme' => 'nullable|string|max:50',
            'is_visible' => 'boolean',
        ]);

        if (! $user->portfolioSetting) {
            $user->portfolioSetting()->create($validated);
        } else {
            $user->portfolioSetting()->update($validated);
        }

        return back()->with('success', 'Portfolio settings updated.');
    }
}
