<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $commonSkills = [
            // Basic Computer Fundamentals
            'MS Word', 'MS Excel', 'MS PowerPoint', 'Windows OS', 'Internet Browsing', 'Email Communication', 'Computer Hardware',
            // Graphic Design
            'Adobe Photoshop', 'Adobe Illustrator', 'Brand Identity', 'Logo Design', 'Print Media Design', 'Typography', 'UI/UX Design',
            // Digital Marketing
            'SEO', 'Social Media Marketing', 'Content Marketing', 'Google Ads', 'Facebook Ads', 'YouTube Marketing', 'Email Marketing',
            // Audio & Video
            'Adobe Premiere Pro', 'Adobe After Effects', 'Video Editing', 'Audio Editing', 'Color Grading', 'Motion Graphics',
            // Web Design
            'HTML5', 'CSS3', 'JavaScript', 'Bootstrap', 'Tailwind CSS', 'Responsive Design', 'Figma to HTML',
            // 2D & 3D Animation
            '2D Animation', '3D Modeling', 'Character Design', 'Blender', 'Autodesk Maya', 'Rendering',
            // Soft Skills
            'Communication', 'Teamwork', 'Problem Solving', 'Time Management', 'Freelancing Basics',
        ];

        foreach ($commonSkills as $skill) {
            Skill::firstOrCreate(['name' => $skill]);
        }
    }
}
