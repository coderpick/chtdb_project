<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\CareerResource;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\SocialResource;
use App\Http\Resources\TrainingResource;
use App\Http\Resources\UserResource;
use App\Models\PortfolioSetting;
use App\Models\SocialLink;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Register a new user.
     */
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'student',
        ]);

        // Create empty related records
        $user->profile()->create();
        $user->training()->create();
        $user->career()->create();
        $user->socialLinks()->create();
        $user->portfolioSetting()->create([
            'slug' => $this->generateUniqueSlug($user->name),
        ]);

        $token = $user->createToken('mobile')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Registration successful',
            'data' => [
                'user' => (new UserResource($user))->toArray(request()),
                'token' => $token,
            ],
        ]);
    }

    /**
     * Login user.
     */
    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }

        // Revoke old tokens? Optionally
        // $user->tokens()->delete();

        $token = $user->createToken('mobile')->plainTextToken;

        // Load all user data for frontend
        $user->load(['profile', 'training.course', 'training.batch', 'training.center', 'career', 'projects', 'skills', 'socialLinks', 'portfolioSetting']);

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'data' => [
                'user' => (new UserResource($user))->toArray(request()),
                'profile' => $user->profile ? (new ProfileResource($user->profile))->toArray(request()) : null,
                'training' => $user->training ? (new TrainingResource($user->training))->toArray(request()) : null,
                'career' => $user->career ? (new CareerResource($user->career))->toArray(request()) : null,
                'projects' => ProjectResource::collection($user->projects)->toArray(request()),
                'skills' => $user->skills->pluck('name'),
                'socials' => new SocialResource($user->socialLinks ?? new SocialLink),
                'portfolio_settings' => $user->portfolioSetting ? [
                    'slug' => $user->portfolioSetting->slug,
                    'theme' => $user->portfolioSetting->theme,
                    'is_visible' => (bool) $user->portfolioSetting->is_visible,
                    'tagline' => $user->portfolioSetting->tagline,
                ] : null,
            ],
        ]);
    }

    /**
     * Logout user (revoke token).
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully',
        ]);
    }

    /**
     * Get authenticated user.
     */
    public function me(Request $request)
    {
        $user = $request->user();
        $user->load(['profile', 'training.course', 'training.batch', 'training.center', 'career', 'projects', 'skills', 'socialLinks', 'portfolioSetting']);

        return response()->json([
            'success' => true,
            'data' => [
                'user' => (new UserResource($user))->toArray(request()),
                'profile' => $user->profile ? (new ProfileResource($user->profile))->toArray(request()) : null,
                'training' => $user->training ? (new TrainingResource($user->training))->toArray(request()) : null,
                'career' => $user->career ? (new CareerResource($user->career))->toArray(request()) : null,
                'projects' => ProjectResource::collection($user->projects)->toArray(request()),
                'skills' => $user->skills->pluck('name'),
                'socials' => new SocialResource($user->socialLinks ?? new SocialLink),
                'portfolio_settings' => $user->portfolioSetting ? [
                    'slug' => $user->portfolioSetting->slug,
                    'theme' => $user->portfolioSetting->theme,
                    'is_visible' => (bool) $user->portfolioSetting->is_visible,
                    'tagline' => $user->portfolioSetting->tagline,
                ] : null,
            ],
        ]);
    }

    /**
     * Generate unique slug from name.
     */
    private function generateUniqueSlug($name, $id = null)
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $counter = 1;

        $query = PortfolioSetting::where('slug', $slug);
        if ($id) {
            $query->where('user_id', '!=', $id);
        }
        while ($query->exists()) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
            $query = PortfolioSetting::where('slug', $slug);
            if ($id) {
                $query->where('user_id', '!=', $id);
            }
        }

        return $slug;
    }
}
