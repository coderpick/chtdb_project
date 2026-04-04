<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class StudentSocialController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        $user->load('socialLinks');

        $socials = $user->socialLinks ?? new SocialLink;

        return view('student.socials.edit', compact('socials'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'linkedin' => 'nullable|url',
            'github' => 'nullable|url',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'website' => 'nullable|url',
            'phone' => 'nullable|string|max:20',
        ]);

        $user = auth()->user();
        $user->socialLinks()->update($validated);

        return back()->with('success', 'Social links updated.');
    }
}
