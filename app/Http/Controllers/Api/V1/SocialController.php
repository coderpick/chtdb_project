<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SocialResource;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    /**
     * Get user's social links.
     */
    public function index(Request $request)
    {
        $social = $request->user()->socialLinks ?? new SocialLink(['user_id' => $request->user()->id]);

        return response()->json([
            'success' => true,
            'data' => new SocialResource($social),
        ]);
    }

    /**
     * Update social links.
     */
    public function update(Request $request)
    {
        $request->validate([
            'linkedin' => ['nullable', 'url', 'max:500'],
            'github' => ['nullable', 'url', 'max:500'],
            'website' => ['nullable', 'url', 'max:500'],
            'facebook' => ['nullable', 'url', 'max:500'],
        ]);

        $user = $request->user();
        $social = $user->socialLinks()->firstOrCreate(['user_id' => $user->id]);
        $social->update($request->only(['linkedin', 'github', 'website', 'facebook']));

        return response()->json([
            'success' => true,
            'message' => 'Social links updated',
            'data' => new SocialResource($social),
        ]);
    }
}
