<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\TrainingCenterController as AdminCenterController;
use App\Http\Controllers\Auth\StudentAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicPortfolioController;
use App\Http\Controllers\Student\StudentCareerController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Student\StudentPortfolioController;
use App\Http\Controllers\Student\StudentProfileController;
use App\Http\Controllers\Student\StudentProjectController;
use App\Http\Controllers\Student\StudentSkillController;
use App\Http\Controllers\Student\StudentSocialController;
use App\Http\Controllers\Student\StudentTrainingController;
use Illuminate\Support\Facades\Route;

// ===== PUBLIC ROUTES =====
Route::get('/', [HomeController::class, 'index'])->name('home');

// Student Authentication (Web Guard)
Route::prefix('student')->name('student.')->group(function () {
    // Guest routes - accessible only to non-authenticated users
    Route::middleware('guest')->group(function () {
        Route::get('login', [StudentAuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [StudentAuthController::class, 'login']);
        Route::get('register', [StudentAuthController::class, 'showRegisterForm'])->name('register');
        Route::post('register', [StudentAuthController::class, 'register']);
    });

    // Protected routes - require authentication and student role
    Route::middleware(['auth', 'student'])->group(function () {
        Route::post('logout', [StudentAuthController::class, 'logout'])->name('logout');

        // Dashboard
        Route::get('dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');

        // Dashboard Modules (prefixed with dashboard)
        Route::prefix('dashboard')->group(function () {
            // Profile
            Route::get('profile', [StudentProfileController::class, 'edit'])->name('profile.edit');
            Route::put('profile', [StudentProfileController::class, 'update'])->name('profile.update');
            Route::post('profile/photo', [StudentProfileController::class, 'uploadPhoto'])->name('profile.photo');

            // Training
            Route::get('training', [StudentTrainingController::class, 'edit'])->name('training.edit');
            Route::put('training', [StudentTrainingController::class, 'update'])->name('training.update');

            // Career
            Route::get('career', [StudentCareerController::class, 'edit'])->name('career.edit');
            Route::put('career', [StudentCareerController::class, 'update'])->name('career.update');

            // Projects
            Route::resource('projects', StudentProjectController::class);

            // Skills
            Route::get('skills', [StudentSkillController::class, 'edit'])->name('skills.edit');
            Route::post('skills', [StudentSkillController::class, 'store'])->name('skills.store');
            Route::delete('skills/{skillName}', [StudentSkillController::class, 'destroy'])->name('skills.destroy');

            // Social Links
            Route::get('socials', [StudentSocialController::class, 'edit'])->name('socials.edit');
            Route::put('socials', [StudentSocialController::class, 'update'])->name('socials.update');

            // Portfolio Settings
            Route::get('portfolio', [StudentPortfolioController::class, 'edit'])->name('portfolio.edit');
            Route::put('portfolio', [StudentPortfolioController::class, 'update'])->name('portfolio.update');
        });
    });
});

// Public Portfolio
Route::get('/portfolio/{slug}', [PublicPortfolioController::class, 'show'])->name('portfolio.public.show');

// ===== ADMIN ROUTES (Existing) =====

// Admin Authentication Routes (no middleware)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout')->middleware('auth');
});

// Admin Protected Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Courses
    Route::resource('courses', AdminCourseController::class);

    // Training Centers
    Route::resource('centers', AdminCenterController::class);

    // Testimonials
    Route::resource('testimonials', AdminTestimonialController::class);

    // Gallery
    Route::resource('gallery', AdminGalleryController::class);

    // Students Management
    Route::get('students', [AdminStudentController::class, 'index'])->name('students.index');
    Route::get('students/{user}', [AdminStudentController::class, 'show'])->name('students.show');
    Route::get('students/{user}/edit', [AdminStudentController::class, 'edit'])->name('students.edit');
    Route::put('students/{user}', [AdminStudentController::class, 'update'])->name('students.update');
});
Route::get('/test', function () {
    return 'OK';
});
