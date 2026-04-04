<?php

use App\Http\Controllers\Api\PublicController;
use App\Http\Controllers\Api\V1\CareerController;
use App\Http\Controllers\Api\V1\PortfolioController;
use App\Http\Controllers\Api\V1\ProfileController;
use App\Http\Controllers\Api\V1\ProjectController;
use App\Http\Controllers\Api\V1\SkillController;
use App\Http\Controllers\Api\V1\SocialController;
use App\Http\Controllers\Api\V1\TrainingController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Public routes
Route::get('/health', function () {
    return response()->json(['status' => 'ok', 'timestamp' => now()]);
});

// ===== AUTH ROUTES =====
Route::prefix('v1/auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
});

// ===== PROTECTED ROUTES (require auth:sanctum) =====
Route::middleware('auth:sanctum')->group(function () {

    // Profile
    Route::prefix('v1/profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index']);
        Route::put('/', [ProfileController::class, 'update']);
        Route::post('/photo', [ProfileController::class, 'uploadPhoto']);
        Route::delete('/photo', [ProfileController::class, 'deletePhoto']);
    });

    // Training
    Route::prefix('v1/training')->group(function () {
        Route::get('/', [TrainingController::class, 'index']);
        Route::put('/', [TrainingController::class, 'update']);
        Route::get('/courses', [TrainingController::class, 'courses']);
        Route::get('/centers', [TrainingController::class, 'centers']);
        Route::get('/batches', [TrainingController::class, 'batches']);
        Route::get('/batches/{courseId}', [TrainingController::class, 'batches']);
    });

    // Career
    Route::prefix('v1/career')->group(function () {
        Route::get('/', [CareerController::class, 'index']);
        Route::put('/', [CareerController::class, 'update']);
    });

    // Projects (Resourceful)
    Route::prefix('v1/projects')->group(function () {
        Route::get('/', [ProjectController::class, 'index']);
        Route::post('/', [ProjectController::class, 'store']);
        Route::get('/{id}', [ProjectController::class, 'show']);
        Route::put('/{id}', [ProjectController::class, 'update']);
        Route::delete('/{id}', [ProjectController::class, 'destroy']);
    });

    // Skills
    Route::prefix('v1/skills')->group(function () {
        Route::get('/', [SkillController::class, 'index']);
        Route::post('/', [SkillController::class, 'store']);
        Route::delete('/{skillName}', [SkillController::class, 'destroy']);
        Route::get('/suggested', [SkillController::class, 'suggested']);
    });

    // Social Links
    Route::prefix('v1/socials')->group(function () {
        Route::get('/', [SocialController::class, 'index']);
        Route::put('/', [SocialController::class, 'update']);
    });

    // Portfolio
    Route::prefix('v1/portfolio')->group(function () {
        Route::get('/', [PortfolioController::class, 'index']);
        Route::put('/', [PortfolioController::class, 'update']);
        Route::get('/check-slug', [PortfolioController::class, 'checkSlug']);
    });
});

// ===== PUBLIC ROUTES =====
Route::prefix('public')->group(function () {
    Route::get('/courses', [PublicController::class, 'courses']);
    Route::get('/courses/{identifier}', [PublicController::class, 'course']);
    Route::get('/centers', [PublicController::class, 'centers']);
    Route::get('/testimonials', [PublicController::class, 'testimonials']);
    Route::get('/gallery', [PublicController::class, 'gallery']);
    Route::get('/portfolio/{slug}', [PublicController::class, 'portfolio']);
    Route::get('/stats', [PublicController::class, 'stats']);
});
