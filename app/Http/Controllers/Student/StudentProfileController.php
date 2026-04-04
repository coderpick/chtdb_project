<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Traits\FileUploadTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentProfileController extends Controller
{
    use FileUploadTrait;

    public function edit()
    {
        $user = auth()->user();
        $user->load('profile');

        return view('student.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {

        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:20',
            'district' => 'nullable|in:rangamati,khagrachhari,bandarban',
            'address' => 'nullable|string|max:500',
            'bio' => 'nullable|string|max:1000',
            'photo' => 'nullable|image|max:2048',
            'upazila' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'nid' => 'nullable|string|max:17',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if ($request->hasFile('photo')) {
            $path = $this->fileUpload($request->file('photo'), 'uploads/student', $user->profile->photo ?? null);
        }

        $user->profile()->update([
            'phone' => $validated['phone'] ?? null,
            'district' => $validated['district'] ?? null,
            'upazila' => $validated['upazila'] ?? null,
            'dob' => ! empty($validated['dob']) ? Carbon::parse($validated['dob'])->format('Y-m-d') : null,
            'gender' => $validated['gender'] ?? null,
            'nid' => $validated['nid'] ?? null,
            'address' => $validated['address'] ?? null,
            'bio' => $validated['bio'] ?? null,
            'photo' => $path ?? $user->profile->photo,
        ]);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|max:2048',
        ]);

        $user = auth()->user();

        // Delete old photo if exists
        if ($user->profile->photo) {
            Storage::disk('public')->delete($user->profile->photo);
        }

        $path = $request->file('photo')->store('profile-photos', 'public');

        $user->profile()->update(['photo' => $path]);

        return back()->with('success', 'Profile photo updated.');
    }
}
