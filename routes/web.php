<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SubCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Admin Auth Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Ana admin route'u - login sayfasına yönlendir
    Route::get('/', function () {
        return redirect()->route('admin.login');
    });

    // Auth Routes - middleware dışında tutulacak
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login-handle', [AuthController::class, 'login'])->name('handle-login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin Protected Routes
    Route::middleware(['auth:admin'])->group(function () {
        // Dashboard route
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        
        // Category Routes
        Route::prefix('category')->name('category.')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/create', [CategoryController::class, 'create'])->name('create');
            Route::post('/store', [CategoryController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('edit');
            Route::post('/{id}/update', [CategoryController::class, 'update'])->name('update');
            Route::get('/{id}/delete', [CategoryController::class, 'destroy'])->name('destroy');
        });

        // SubCategory Routes 
        Route::prefix('sub-category')->name('sub-category.')->group(function () {
            Route::get('/', [SubCategoryController::class, 'index'])->name('index');
            Route::get('/create', [SubCategoryController::class, 'create'])->name('create');
            Route::post('/store', [SubCategoryController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [SubCategoryController::class, 'edit'])->name('edit');
            Route::post('/{id}/update', [SubCategoryController::class, 'update'])->name('update');
            Route::get('/{id}/delete', [SubCategoryController::class, 'destroy'])->name('destroy');
        });

        // Product Routes
        Route::prefix('product')->name('product.')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('/create', [ProductController::class, 'create'])->name('create');
            Route::post('/store', [ProductController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');
            Route::post('/{id}/update', [ProductController::class, 'update'])->name('update');
            Route::get('/{id}/delete', [ProductController::class, 'destroy'])->name('destroy');
            Route::get('/{id}/get-sub-category', [ProductController::class, 'getSubCategory'])
                ->name('admin.product.get-sub-category');
        });

        // Order Routes
        Route::prefix('order')->name('order.')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('index');
            Route::get('/{id}/detail', [OrderController::class, 'detail'])->name('detail');
            Route::post('/{id}/change-status', [OrderController::class, 'changeStatus'])->name('change.status');
        });

        // Review Routes
        Route::prefix('review')->name('review.')->group(function () {
            Route::get('/', [ReviewController::class, 'index'])->name('index');
            Route::get('/{id}/detail', [ReviewController::class, 'detail'])->name('detail');
            Route::post('/{id}/change-status', [ReviewController::class, 'changeStatus'])->name('change.status');
        });

        // About Routes - Eski
        Route::get('/about', [AboutController::class, 'index'])->name('about');
        Route::post('/about/update', [AboutController::class, 'update'])->name('about.update');

        // About Routes - Yeni (Bu şekilde değiştirin)
        Route::get('/about', [AboutController::class, 'index'])->name('about');
        Route::post('/about', [AboutController::class, 'update'])->name('about.update');

        Route::get('/contact', [ContactController::class, 'index'])->name('contact');
        Route::post('/contact', [ContactController::class, 'update'])->name('contact.update');

        // Service Routes
        Route::prefix('service')->name('service.')->group(function () {
            Route::get('/', [ServiceController::class, 'index'])->name('index');
            Route::get('/create', [ServiceController::class, 'create'])->name('create');
            Route::post('/store', [ServiceController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [ServiceController::class, 'edit'])->name('edit');
            Route::post('/{id}/update', [ServiceController::class, 'update'])->name('update');
            Route::get('/{id}/delete', [ServiceController::class, 'destroy'])->name('destroy');
        });

        // Blog Routes
        Route::prefix('blog')->name('blog.')->group(function () {
            Route::get('/', [BlogController::class, 'index'])->name('index');
            Route::get('/create', [BlogController::class, 'create'])->name('create');
            Route::post('/store', [BlogController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [BlogController::class, 'edit'])->name('edit');
            Route::post('/{id}/update', [BlogController::class, 'update'])->name('update');
            Route::get('/{id}/delete', [BlogController::class, 'destroy'])->name('destroy');
        });
    });
});
