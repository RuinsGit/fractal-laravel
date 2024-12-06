<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\PartnerController;
use App\Http\Controllers\Api\EducationTitleController;
use App\Http\Controllers\Api\StudyingProgramController;
use App\Http\Controllers\Api\CompanyNameController;
use App\Http\Controllers\Api\AdvantageController;
use App\Http\Controllers\Api\HistoryController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\AboutVisionController;
use App\Http\Controllers\Api\AboutCompanyController;
use App\Http\Controllers\Api\ServicesTitleController;
use App\Http\Controllers\Api\DigitalPsychologyTitleController;
use App\Http\Controllers\Api\GalleryTitleController;
use App\Http\Controllers\Api\ContactTitleController;
use App\Http\Controllers\Api\BlogTitleController;
use App\Http\Controllers\Api\PsychologyTextController;
use App\Http\Controllers\Api\HumanDesignController;
use App\Http\Controllers\Api\HumanContentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Dil gerektiren route'lar
Route::middleware('language')->group(function () {
    Route::get('/company-names', [CompanyNameController::class, 'index']);
    Route::get('/company', [CompanyController::class, 'index']);
    // Category Routes
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::get('/{id}', [CategoryController::class, 'show']);
    });

    // Education Title Route
    Route::get('/education-titles', [EducationTitleController::class, 'index']);
    
// Studying Program Route
Route::get('/studying-programs', [StudyingProgramController::class, 'index']);



    // SubCategory Routes
    Route::prefix('sub-categories')->group(function () {
        Route::get('/', [SubCategoryController::class, 'index']);
        Route::get('/{id}', [SubCategoryController::class, 'show']);
    });

    // Category bazlı SubCategories
    Route::get('/categories/{categoryId}/sub-categories', [SubCategoryController::class, 'getByCategory']);

    // Product Routes
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::get('/{id}', [ProductController::class, 'show']);
    });

    Route::get('/advantages', [AdvantageController::class, 'index']);

    // About Company Route
Route::get('/about-company', [AboutCompanyController::class, 'index']);

    // About Vision Route
    Route::get('/about-vision', [AboutVisionController::class, 'index']);

    // History Routes
    Route::prefix('histories')->group(function () {
        Route::get('/', [HistoryController::class, 'index']);
        Route::get('/{id}', [HistoryController::class, 'show']);
    });

    // Course Routes
    Route::prefix('courses')->group(function () {
        Route::get('/', [CourseController::class, 'index']);
        Route::get('/{id}', [CourseController::class, 'show']);
    });

    // Services Title Route
    Route::get('/services-title', [ServicesTitleController::class, 'index']);

    // Digital Psychology Title Route
    Route::get('/digital-psychology-title', [DigitalPsychologyTitleController::class, 'index']);
    
    // Gallery Title Route
    Route::get('/gallery-titles', [GalleryTitleController::class, 'index']);

    // Contact Title Route
    Route::get('/contact-titles', [ContactTitleController::class, 'index']);

    // Blog Title Route
    Route::get('/blog-titles', [BlogTitleController::class, 'index']);

    // Psychology Text Route
    Route::get('/psychology-texts', [PsychologyTextController::class, 'index']);

    // Human Design Route
    Route::get('/human-designs', [HumanDesignController::class, 'index']);
    // Human Content Routes
Route::prefix('human-contents')->group(function () {
    Route::get('/', [HumanContentController::class, 'index']);
    Route::get('/{id}', [HumanContentController::class, 'show']);
});

});

// Dil gerektirmeyen route'lar
Route::prefix('partners')->group(function () {
    Route::get('/', [PartnerController::class, 'index']);
    Route::get('/{id}', [PartnerController::class, 'show']);
});

Route::get('/blogs', [BlogController::class, 'index']);



