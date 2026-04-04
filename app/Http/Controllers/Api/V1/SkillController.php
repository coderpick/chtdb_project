<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * List user's skills.
     */
    public function index(Request $request)
    {
        $skills = $request->user()->skills()->pluck('name')->toArray();

        return response()->json([
            'success' => true,
            'data' => $skills,
        ]);
    }

    /**
     * Add skill(s).
     * Expects JSON: { "skills": ["php", "laravel"] } or single { "skill": "php" }
     */
    public function store(Request $request)
    {
        $request->validate([
            'skills' => 'required|array',
            'skills.*' => 'string|max:100',
        ]);

        $user = $request->user();
        $skillNames = array_unique(array_map('trim', $request->skills));

        $skillIds = [];
        foreach ($skillNames as $name) {
            $skill = Skill::firstOrCreate(['name' => $name]);
            $skillIds[] = $skill->id;
            // Attach if not already attached
            $user->skills()->syncWithoutDetaching([$skill->id]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Skills added',
            'data' => $user->skills()->pluck('name')->toArray(),
        ]);
    }

    /**
     * Remove a skill.
     */
    public function destroy(Request $request, $skillName)
    {
        $user = $request->user();
        $skill = Skill::where('name', $skillName)->first();

        if ($skill) {
            $user->skills()->detach($skill->id);

            return response()->json([
                'success' => true,
                'message' => 'Skill removed',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Skill not found',
        ], 404);
    }

    /**
     * Get suggested skills (all available skills).
     */
    public function suggested(Request $request)
    {
        $skills = Skill::orderBy('name')->pluck('name')->toArray();

        return response()->json([
            'success' => true,
            'data' => $skills,
        ]);
    }
}
