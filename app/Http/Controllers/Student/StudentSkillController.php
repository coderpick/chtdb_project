<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class StudentSkillController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        $user->load('skills');

        $currentSkills = $user->skills->pluck('name')->toArray();

        $suggestedSkills = Skill::whereNotIn('name', $currentSkills)->orderBy('name')->pluck('name')->toArray();

        return view('student.skills.edit', compact('currentSkills', 'suggestedSkills'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'skill' => 'required|string|max:50',
        ]);

        $user = auth()->user();
        $skillName = trim($request->skill);

        $skill = Skill::firstOrCreate(['name' => $skillName]);

        if (! $user->skills()->where('skill_id', $skill->id)->exists()) {
            $user->skills()->attach($skill->id);
        }

        return back()->with('success', "Skill '$skillName' added.");
    }

    public function destroy($skillName)
    {
        $user = auth()->user();
        $skill = Skill::where('name', $skillName)->first();

        if ($skill) {
            $user->skills()->detach($skill->id);
        }

        return back()->with('success', 'Skill removed.');
    }
}
