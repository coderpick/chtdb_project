<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\District;
use App\Models\SuccessStory;
use App\Models\Upazila;
use App\Models\User;
use Illuminate\Http\Request;

class SuccessStoryController extends Controller
{
    public function index(Request $request)
    {
        $query = SuccessStory::with(['user.studentProfile', 'career', 'district', 'upazila']);

        if ($request->filled('name')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%');
            });
        }

        if ($request->filled('district_id')) {
            $query->where('district_id', $request->district_id);
        }

        if ($request->filled('upazila_id')) {
            $query->where('upazila_id', $request->upazila_id);
        }

        $successStories = $query->latest()->paginate(15)->withQueryString();
        $districts = District::all();

        return view('admin.success_stories.index', compact('successStories', 'districts'));
    }

    public function create()
    {
        $users = User::where('role', 'student')->with('studentProfile')->get();
        $districts = District::all();
        $careers = Career::with('user')->get();

        return view('admin.success_stories.create', compact('users', 'districts', 'careers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'district_id' => 'required|exists:districts,id',
            'upazila_id' => 'nullable|exists:upazilas,id',
            'career_id' => 'nullable|exists:careers,id',
            'story_text' => 'required|string',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        SuccessStory::create($validated);

        return redirect()->route('admin.success-stories.index')
            ->with('success', 'Success Story added successfully.');
    }

    public function edit(SuccessStory $successStory)
    {
        $users = User::where('role', 'student')->with('studentProfile')->get();
        $districts = District::all();
        $upazilas = Upazila::where('district_id', $successStory->district_id)->get();
        $careers = Career::with('user')->get();

        return view('admin.success_stories.edit', compact('successStory', 'users', 'districts', 'upazilas', 'careers'));
    }

    public function update(Request $request, SuccessStory $successStory)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'district_id' => 'required|exists:districts,id',
            'upazila_id' => 'nullable|exists:upazilas,id',
            'career_id' => 'nullable|exists:careers,id',
            'story_text' => 'required|string',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $successStory->update($validated);

        return redirect()->route('admin.success-stories.index')
            ->with('success', 'Success Story updated successfully.');
    }

    public function getUpazilas(District $district)
    {
        return response()->json($district->upazilas);
    }

    public function approve(SuccessStory $successStory)
    {
        $successStory->update(['status' => 'approved']);

        return back()->with('success', 'Success Story approved.');
    }

    public function reject(SuccessStory $successStory)
    {
        $successStory->update(['status' => 'rejected']);

        return back()->with('success', 'Success Story rejected.');
    }

    public function destroy(SuccessStory $successStory)
    {
        $successStory->delete();

        return redirect()->route('admin.success-stories.index')
            ->with('success', 'Success Story deleted successfully.');
    }
}
