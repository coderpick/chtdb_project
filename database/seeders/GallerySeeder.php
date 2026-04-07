<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleryPath = public_path('img/gallery');
        
        if (!File::exists($galleryPath)) {
            File::makeDirectory($galleryPath, 0755, true);
        }

        $files = File::files($galleryPath);
        
        // Filter for image files
        $imageFiles = array_filter($files, function($file) {
            return in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
        });

        // Clear existing gallery records to avoid duplicates when re-seeding
        Gallery::truncate();

        foreach ($imageFiles as $index => $file) {
            $filename = $file->getFilename();
            
            // Create a simple caption from the filename
            $caption = ucwords(str_replace(['-', '_'], ' ', pathinfo($filename, PATHINFO_FILENAME)));
            
            Gallery::create([
                'image_path' => 'img/gallery/' . $filename,
                'caption' => $caption,
                'category' => $index % 2 == 0 ? 'Training' : 'Events',
                'sort_order' => $index,
                'is_active' => true,
            ]);
        }
    }
}
