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
            // Web Development
            'PHP', 'Laravel', 'JavaScript', 'HTML', 'CSS', 'MySQL', 'React', 'Vue.js', 'Node.js',
            // Graphic Design
            'Photoshop', 'Illustrator', 'UI/UX', 'Figma', 'InDesign',
            // Mobile Development
            'Android', 'iOS', 'React Native', 'Flutter', 'Kotlin', 'Swift',
            // Digital Marketing
            'SEO', 'Social Media Marketing', 'Google Ads', 'Facebook Ads', 'Content Writing',
            // Database
            'MongoDB', 'PostgreSQL', 'SQL', 'NoSQL',
            // E-commerce
            'WooCommerce', 'Shopify', 'Payment Gateway', 'Product Management',
            // Cyber Security
            'Network Security', 'Ethical Hacking', 'Firewall', 'Penetration Testing',
            // Video Editing
            'Premiere Pro', 'After Effects', 'Final Cut Pro', 'DaVinci Resolve',
            // General
            'Communication', 'Teamwork', 'Problem Solving', 'Time Management', 'Project Management',
        ];

        foreach ($commonSkills as $skill) {
            Skill::firstOrCreate(['name' => $skill]);
        }
    }
}
