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
            'skills' => 'nullable|string',
        ]);

        $user = auth()->user();
        $skillsInput = $request->skills;
        $skillsData = json_decode($skillsInput, true);
        
        if (is_null($skillsData) && !empty($skillsInput)) {
            // Fallback for non-JSON comma-separated string
            $skillsData = array_map(function($s) {
                return ['value' => trim($s)];
            }, array_filter(explode(',', $skillsInput)));
        }

        $skillsData = $skillsData ?? [];
        $skillIds = [];

        foreach ($skillsData as $data) {
            $skillName = trim($data['value'] ?? '');
            if (empty($skillName)) continue;

            $skill = Skill::firstOrCreate(['name' => $skillName]);
            $skillIds[] = $skill->id;
        }

        $user->skills()->sync($skillIds);

        return back()->with('success', 'Skills updated successfully.');
    }

    public function destroy($skillName)
    {
        // No longer used as sync() handles removal
        return back();
    }
}
