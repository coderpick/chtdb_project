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
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['unemployed', 'job', 'freelance', 'entrepreneur', 'job_freelance'])->nullable();
            $table->decimal('income', 15, 2)->nullable();
            // Job fields
            $table->string('company', 200)->nullable();
            $table->string('designation', 150)->nullable();
            $table->date('join_date')->nullable();
            $table->string('location', 200)->nullable();
            // Freelance fields
            $table->string('platform', 100)->nullable();
            $table->string('profile_link', 500)->nullable();
            $table->integer('completed_projects')->default(0);
            $table->decimal('rating', 3, 2)->nullable();
            // Entrepreneur fields
            $table->string('business_name', 200)->nullable();
            $table->string('business_type', 150)->nullable();
            $table->integer('employees')->nullable();
            $table->string('business_website', 500)->nullable();
            $table->text('story')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};
