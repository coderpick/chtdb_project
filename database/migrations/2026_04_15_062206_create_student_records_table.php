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
        Schema::create('student_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('district_id')->constrained('districts')->onDelete('cascade');
            $table->foreignId('upazila_id')->nullable()->constrained('upazilas')->onDelete('cascade');
            $table->string('batch_id')->constrained('batches')->onDelete('cascade');
            $table->string('name');
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->text('academic_qualification')->nullable();
            $table->text('address')->nullable();
            $table->string('freelancer_profile_url')->nullable();
            $table->string('profile_photo')->nullable();
            $table->string('income_source')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /* drop foreign keys */

        Schema::table('student_records', function (Blueprint $table) {
            $table->dropForeign(['district_id']);
            $table->dropForeign(['upazila_id']);
            $table->dropForeign(['batch_id']);
        });
        Schema::dropIfExists('student_records');
    }
};
