<?php

namespace App\Http\Controllers;

use App\Models\PortfolioSetting;

class PublicPortfolioController extends Controller
{
    public function show($slug)
    {
        $portfolio = PortfolioSetting::with('user.studentProfile', 'user.training.district', 'user.career', 'user.projects', 'user.skills', 'user.socialLinks')
            ->where('slug', $slug)
            ->firstOrFail();

        // Check visibility
        if (! $portfolio->is_visible) {
            abort(404);
        }

        $user = $portfolio->user;

        return view('public.portfolio.show', compact('user', 'portfolio'));
    }
}
