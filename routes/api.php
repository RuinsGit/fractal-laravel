<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\PartnerController;
use App\Http\Controllers\Api\CompanyNameController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

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

// Kategori bazlı alt kategoriler
Route::get('categories/{categoryId}/sub-categories', [SubCategoryController::class, 'getByCategory']);

// Education Title Routes
Route::prefix('education-titles')->group(function () {
    Route::get('/', [EducationTitleController::class, 'index']);
    Route::get('/{id}', [EducationTitleController::class, 'show']);
});

// Studying Program Route
Route::get('/studying-programs', [StudyingProgramController::class, 'index']);

// Company Name Route
Route::get('/company-names', [CompanyNameController::class, 'index']);
