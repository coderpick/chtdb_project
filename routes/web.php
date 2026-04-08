<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminMessageController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Admin\SuccessStoryController as AdminSuccessStoryController;
use App\Http\Controllers\Admin\TrainingCenterController as AdminCenterController;
use App\Http\Controllers\Auth\StudentAuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicPortfolioController;
use App\Http\Controllers\Student\StudentCareerController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Student\StudentPortfolioController;
use App\Http\Controllers\Student\StudentProfileController;
use App\Http\Controllers\Student\StudentProjectController;
use App\Http\Controllers\Student\StudentSkillController;
use App\Http\Controllers\Student\StudentSocialController;
use App\Http\Controllers\Student\StudentSuccessStoryController;
use App\Http\Controllers\Student\StudentTrainingController;
use App\Models\Batch;
use App\Models\Upazila;
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
            Route::get('training', [StudentTrainingController::class, 'index'])->name('training.index');
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

            /*  write success-story */
            Route::get('success-story', [StudentSuccessStoryController::class, 'edit'])->name('success-story.edit');
            Route::put('success-story', [StudentSuccessStoryController::class, 'update'])->name('success-story.update');
        });
    });
});

// Public Portfolio
Route::get('/portfolio/{slug}', [PublicPortfolioController::class, 'show'])->name('portfolio.public.show');

/* contact form submission */
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

/* get upazial by district */
Route::get('/upazilas/{district}', function ($district) {
    $upazilas = Upazila::where('district_id', $district)->get();

    return response()->json($upazilas);
})->name('upazilas.by.district');
/* get training center batches */
Route::get('/training-center/{training_center}/batches', function ($training_center) {
    $batches = Batch::where('training_center_id', $training_center)->get();

    return response()->json($batches);
})->name('training-center.batches');

/* get upazila by district */
Route::get('/district/{district}/upazilas', function ($district) {
    $upazilas = Upazila::where('district_id', $district)->get();

    return response()->json($upazilas);
})->name('upazilas.by.district');

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

    // Success Stories
    Route::resource('success-stories', AdminSuccessStoryController::class);
    Route::patch('success-stories/{success_story}/approve', [AdminSuccessStoryController::class, 'approve'])->name('success-stories.approve');
    Route::patch('success-stories/{success_story}/reject', [AdminSuccessStoryController::class, 'reject'])->name('success-stories.reject');
    Route::get('districts/{district}/upazilas', [AdminSuccessStoryController::class, 'getUpazilas'])->name('districts.upazilas');

    // Gallery
    Route::resource('gallery', AdminGalleryController::class);

    // Messages
    Route::get('messages', [AdminMessageController::class, 'index'])->name('messages.index');
    Route::get('messages/{message}', [AdminMessageController::class, 'show'])->name('messages.show');
    Route::delete('messages/{message}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');

    // Students Management
    Route::get('students', [AdminStudentController::class, 'index'])->name('students.index');
    Route::get('students/{user}', [AdminStudentController::class, 'show'])->name('students.show');
    Route::get('students/{user}/edit', [AdminStudentController::class, 'edit'])->name('students.edit');
    Route::put('students/{user}', [AdminStudentController::class, 'update'])->name('students.update');

    // Site Settings
    Route::get('settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});
