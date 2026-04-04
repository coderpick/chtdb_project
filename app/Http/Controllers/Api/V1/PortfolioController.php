<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PortfolioSettingRequest;
use App\Http\Resources\PortfolioPublicResource;
use App\Models\PortfolioSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
    /**
     * Get user's portfolio settings and combined data.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $user->load(['profile', 'training.course', 'training.batch', 'training.center', 'career', 'projects', 'skills', 'socialLinks', 'portfolioSetting']);

        return response()->json([
            'success' => true,
            'data' => [
                'settings' => [
                    'slug' => $user->portfolioSetting?->slug,
                    'theme' => $user->portfolioSetting?->theme,
                    'is_visible' => (bool) $user->portfolioSetting?->is_visible,
                    'tagline' => $user->portfolioSetting?->tagline,
                ],
                // Also return public data representation for preview
                'portfolio' => new PortfolioPublicResource($user),
            ],
        ]);
    }

    /**
     * Update portfolio settings.
     */
    public function update(PortfolioSettingRequest $request)
    {
        $user = $request->user();
        $portfolio = $user->portfolioSetting ?? $user->portfolioSetting()->create(['slug' => $request->slug ?? $this->generateSlug($user->name)]);

        $portfolio->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Portfolio settings updated',
            'data' => [
                'slug' => $portfolio->slug,
                'theme' => $portfolio->theme,
                'is_visible' => (bool) $portfolio->is_visible,
                'tagline' => $portfolio->tagline,
            ],
        ]);
    }

    /**
     * Check if a slug is available.
     */
    public function checkSlug(Request $request)
    {
        $request->validate([
            'slug' => ['required', 'string', 'min:3', 'max:50', 'regex:/^[a-z0-9-]+$/'],
        ]);

        $exists = PortfolioSetting::where('slug', $request->slug)
            ->where('user_id', '!=', $request->user()->id)
            ->exists();

        return response()->json([
            'success' => true,
            'data' => [
                'available' => ! $exists,
            ],
        ]);
    }

    /**
     * Generate a unique slug from name.
     */
    private function generateSlug($name)
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $counter = 1;

        while (PortfolioSetting::where('slug', $slug)->exists()) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
        }

        return $slug;
    }
}
