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
        $user->load('studentProfile');

        return view('student.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {

        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:20',
            'district_id' => 'nullable|exists:districts,id',
            'upazila_id' => 'nullable|exists:upazilas,id',
            'address' => 'nullable|string|max:500',
            'bio' => 'nullable|string|max:1000',
            'photo' => 'nullable|image|max:2048',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'nid' => 'nullable|string|max:17',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if ($request->hasFile('photo')) {
            $path = $this->fileUpload($request->file('photo'), 'uploads/student', $user->studentProfile->photo ?? null);
        }

        $user->studentProfile()->update([
            'phone' => $validated['phone'] ?? null,
            'district_id' => $validated['district_id'] ?? null,
            'upazila_id' => $validated['upazila_id'] ?? null,
            'dob' => ! empty($validated['dob']) ? Carbon::parse($validated['dob'])->format('Y-m-d') : null,
            'gender' => $validated['gender'] ?? null,
            'nid' => $validated['nid'] ?? null,
            'address' => $validated['address'] ?? null,
            'bio' => $validated['bio'] ?? null,
            'photo' => $path ?? $user->studentProfile->photo,
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
        if ($user->studentProfile->photo) {
            Storage::disk('public')->delete($user->studentProfile->photo);
        }

        $path = $request->file('photo')->store('profile-photos', 'public');

        $user->studentProfile()->update(['photo' => $path]);

        return back()->with('success', 'Profile photo updated.');
    }
}
