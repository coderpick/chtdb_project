<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('testimonials');
        
        Schema::create('success_stories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');          
            $table->foreignId('district_id')->constrained('districts')->onDelete('cascade');        
            $table->foreignId('upazila_id')->nullable()->constrained('upazilas')->onDelete('cascade');
            $table->foreignId('career_id')->nullable()->constrained()->onDelete('cascade');
            $table->text('story_text');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('success_stories');
    }
};
