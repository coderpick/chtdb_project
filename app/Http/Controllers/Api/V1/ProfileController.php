<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Get user profile.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $profile = $user->profile;

        return response()->json([
            'success' => true,
            'data' => [
                'user' => new UserResource($user),
                'profile' => $profile ? new ProfileResource($profile) : null,
            ],
        ]);
    }

    /**
     * Update profile.
     */
    public function update(ProfileRequest $request)
    {
        $user = $request->user();
        $profile = $user->profile;

        $data = $request->validated();
        $profile->update($data);

        // Update user name/email if changed
        if (isset($data['name'])) {
            $user->name = $data['name'];
        }
        if (isset($data['email'])) {
            $user->email = $data['email'];
        }
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully',
            'data' => [
                'user' => new UserResource($user),
                'profile' => new ProfileResource($profile),
            ],
        ]);
    }

    /**
     * Upload profile photo.
     */
    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'photo' => ['required', 'image', 'max:2048'], // max 2MB
        ]);

        $user = $request->user();
        $profile = $user->profile;

        if (! $profile) {
            $profile = $user->profile()->create();
        }

        // Delete old photo if exists
        if ($profile->photo) {
            Storage::disk('public')->delete($profile->photo);
        }

        $path = $request->file('photo')->store('profile-photos', 'public');

        $profile->update(['photo' => $path]);

        return response()->json([
            'success' => true,
            'message' => 'Photo uploaded successfully',
            'data' => [
                'photo_url' => Storage::url($path),
                'profile' => new ProfileResource($profile),
            ],
        ]);
    }

    /**
     * Delete profile photo.
     */
    public function deletePhoto(Request $request)
    {
        $user = $request->user();
        $profile = $user->profile;

        if ($profile && $profile->photo) {
            Storage::disk('public')->delete($profile->photo);
            $profile->update(['photo' => null]);

            return response()->json([
                'success' => true,
                'message' => 'Photo deleted successfully',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No photo to delete',
        ], 404);
    }
}
