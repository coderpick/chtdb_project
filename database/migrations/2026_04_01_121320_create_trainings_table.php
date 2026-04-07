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
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('batch_id')->nullable()->constrained()->nullOnDelete();       
            $table->foreignId('district_id')->constrained('districts')->onDelete('cascade');        
            $table->foreignId('upazila_id')->constrained('upazilas')->onDelete('cascade');
            $table->enum('status', ['ongoing', 'completed'])->default('ongoing');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('certificate_no', 100)->nullable();
            $table->string('grade', 20)->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
