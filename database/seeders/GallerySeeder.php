<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['caption' => 'Training session at Rangamati center', 'category' => 'Training', 'image' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=800'],
            ['caption' => 'Student success celebration', 'category' => 'Events', 'image' => 'https://images.unsplash.com/photo-1523240715639-960bc2f10d29?w=800'],
            ['caption' => 'Workshop on Digital Marketing', 'category' => 'Training', 'image' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=800'],
            ['caption' => 'CHTDB officials visit', 'category' => 'Visit', 'image' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=800'],
            ['caption' => 'Hands-on Web Development training', 'category' => 'Training', 'image' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?w=800'],
            ['caption' => 'Graphic Design class in progress', 'category' => 'Training', 'image' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=800'],
        ];

        foreach ($items as $index => $item) {
            Gallery::create([
                'image_path' => $item['image'],
                'caption' => $item['caption'],
                'category' => $item['category'],
                'sort_order' => $index,
                'is_active' => true,
            ]);
        }
    }
}
