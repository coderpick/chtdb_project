<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\SuccessStory;
use Illuminate\Http\Request;

class StudentSuccessStoryController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        
        if(!$user->training()->exists()){
            return redirect()->route('student.training.index')->with('error', 'আপনার প্রশিক্ষণের তথ্য প্রথমে প্রদান করুন।');
        }

        $successStory = SuccessStory::where('user_id', $user->id)->first();

        return view('student.success_story.edit', compact('user', 'successStory'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'story_text' => 'required|string|min:50|max:5000',
        ]);

        $user = auth()->user();
        $user->load('studentProfile', 'career');

        if(!$user->studentProfile || !$user->studentProfile->district_id) {
             return back()->with('error', 'আপনার প্রোফাইলে জেলা তথ্য নেই। অনুগ্রহ করে প্রোফাইল আপডেট করুন।');
        }

        SuccessStory::updateOrCreate(
            ['user_id' => $user->id],
            [
                'district_id' => $user->studentProfile->district_id,
                'upazila_id' => $user->studentProfile->upazila_id,
                'career_id' => $user->career->id ?? null,
                'story_text' => $validated['story_text'],
                'status' => 'pending', // Re-verify on every update
            ]
        );

        return back()->with('success', 'আপনার সফলতার গল্পটি সফলভাবে সেভ হয়েছে এবং অনুমোদনের জন্য অপেক্ষমাণ আছে।');
    }
}
