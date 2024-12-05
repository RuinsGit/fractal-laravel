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

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Blog Routes
Route::get('/blogs', [BlogController::class, 'index']);

// Category Routes
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{id}', [CategoryController::class, 'show']);
});

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

// Company Route
Route::get('/company', [CompanyController::class, 'index']);

// Partner Routes
Route::prefix('partners')->group(function () {
    Route::get('/', [PartnerController::class, 'index']);
    Route::get('/{id}', [PartnerController::class, 'show']);
});

// Education Title Route
Route::get('/education-titles', [EducationTitleController::class, 'index']);

// Studying Program Route
Route::get('/studying-programs', [StudyingProgramController::class, 'index']);

// Company Name Route
Route::get('/company-names', [CompanyNameController::class, 'index']);
