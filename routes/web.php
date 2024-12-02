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
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\LeaderController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ProductVideoController;

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


Route::prefix('admin')->name('admin.')->group(function () {
    // Main admin route - redirects to the login page
    Route::get('/', function () {
        return redirect()->route('admin.login');
    });

    // ------------------------- Login Routes Started -------------------------
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login-handle', [AuthController::class, 'login'])->name('handle-login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    // ------------------------- Login Routes Ended -------------------------

   
    Route::middleware(['auth:admin'])->group(function () {
       // ------------------------- Dashboard Routes Started -------------------------
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        // ------------------------- Dashboard Routes Ended -------------------------



        
        // ------------------------- Category Routes Started -------------------------
        Route::controller(CategoryController::class)->prefix('category')->name('category.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::get('/delete/{id}', 'destroy')->name('destroy');
        });
        // ------------------------- Category Routes Ended -------------------------




       // ------------------------- SubCategory Routes Started -------------------------
        Route::prefix('sub-category')->name('sub-category.')->group(function () {
            Route::get('/', [SubCategoryController::class, 'index'])->name('index');
            Route::get('/create', [SubCategoryController::class, 'create'])->name('create');
            Route::post('/store', [SubCategoryController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [SubCategoryController::class, 'edit'])->name('edit');
            Route::post('/{id}/update', [SubCategoryController::class, 'update'])->name('update');
            Route::get('/{id}/delete', [SubCategoryController::class, 'destroy'])->name('destroy');
        });
        // ------------------------- SubCategory Routes Ended -------------------------




       // ------------------------- Products Routes Started -------------------------
        Route::prefix('product')->name('product.')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('/create', [ProductController::class, 'create'])->name('create');
            Route::post('/store', [ProductController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');
            Route::post('/{id}/update', [ProductController::class, 'update'])->name('update');
            Route::get('/{id}/delete', [ProductController::class, 'destroy'])->name('destroy');
            Route::get('/{id}/show', [ProductController::class, 'show'])->name('show');
            Route::get('/get-sub-category/{category_id}', [ProductController::class, 'getSubCategory'])
                ->name('get-sub-category');
            
            Route::delete('/video/{id}', [ProductController::class, 'deleteVideo'])->name('video.delete');
        });
        // ------------------------- Products Routes Ended -------------------------
        


        // ------------------------- Order Routes Started -------------------------
        Route::prefix('order')->name('order.')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('index');
            Route::get('/detail/{id}', [OrderController::class, 'detail'])->name('detail');
            Route::post('/{id}/change-status', [OrderController::class, 'changeStatus'])->name('change-status');
            Route::get('/{id}/destroy', [OrderController::class, 'destroy'])->name('destroy');
        });
        // ------------------------- Order Routes Ended -------------------------



        // ------------------------- Review Routes Started -------------------------
        Route::prefix('review')->name('review.')->group(function () {
            Route::get('/', [ReviewController::class, 'index'])->name('index');
            Route::get('/{id}/detail', [ReviewController::class, 'detail'])->name('detail');
            Route::post('/{id}/change-status', [ReviewController::class, 'changeStatus'])->name('change.status');
        });
        // ------------------------- Review Routes Ended -------------------------




        // ------------------------- About Routes Started -------------------------
        Route::get('/about', [AboutController::class, 'index'])->name('about');
        Route::post('/about/update', [AboutController::class, 'update'])->name('about.update');

        
        Route::get('/about', [AboutController::class, 'index'])->name('about');
        Route::post('/about', [AboutController::class, 'update'])->name('about.update');
        
        // ------------------------- About Routes Ended -------------------------



        // ------------------------- Contact Routes Started -------------------------
    
        Route::get('/contact', [ContactController::class, 'index'])->name('contact');
        Route::post('/contact', [ContactController::class, 'update'])->name('contact.update');

        // ------------------------- Contact Routes Ended -------------------------

        // ------------------------- Services Routes Started -------------------------
        Route::prefix('service')->name('service.')->group(function () {
            Route::get('/', [ServiceController::class, 'index'])->name('index');
            Route::get('/create', [ServiceController::class, 'create'])->name('create');
            Route::post('/store', [ServiceController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [ServiceController::class, 'edit'])->name('edit');
            Route::post('/{id}/update', [ServiceController::class, 'update'])->name('update');
            Route::get('/{id}/delete', [ServiceController::class, 'destroy'])->name('destroy');
        });
        // ------------------------- Services Routes Ended -------------------------



        // ------------------------- Blog Routes Started -------------------------
        Route::prefix('blog')->name('blog.')->controller(BlogController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::get('/destroy/{id}', 'destroy')->name('destroy');
        });
        // ------------------------- Blog Routes Ended -------------------------

        Route::get('contact-messages', [ContactMessageController::class, 'index'])->name('contact-message.index');
        Route::get('contact-messages/{id}', [ContactMessageController::class, 'show'])->name('contact-message.show');
        Route::delete('contact-messages/{id}', [ContactMessageController::class, 'destroy'])->name('contact-message.destroy');
        Route::post('contact-messages/{id}/mark-as-read', [ContactMessageController::class, 'markAsRead'])->name('contact-message.mark-as-read');

        // Leader Routes
        Route::prefix('leader')->name('leader.')->controller(App\Http\Controllers\Admin\LeaderController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::get('/destroy/{id}', 'destroy')->name('destroy');
        });

        // Gallery Routes
        Route::prefix('gallery')->name('gallery.')->controller(App\Http\Controllers\Admin\GalleryController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::get('/destroy/{id}', 'destroy')->name('destroy');
        });

        Route::group(['prefix' => 'product/video', 'as' => 'product.video.'], function () {
            Route::get('/{video}/download', [ProductVideoController::class, 'download'])->name('download');
            Route::post('/update-duration', [ProductVideoController::class, 'updateDuration'])->name('update-duration');
            Route::post('/increment-view', [ProductVideoController::class, 'incrementView'])->name('increment-view');
            Route::post('/rate', [ProductVideoController::class, 'rate'])->name('rate');
            Route::delete('/{video}', [ProductVideoController::class, 'destroy'])->name('destroy');
        });

        // Comment Routes
        Route::group(['prefix' => 'comment', 'as' => 'comment.'], function () {
            Route::get('/', [App\Http\Controllers\Admin\CommentController::class, 'index'])->name('index');
            Route::get('/create', [App\Http\Controllers\Admin\CommentController::class, 'create'])->name('create');
            Route::post('/store', [App\Http\Controllers\Admin\CommentController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [App\Http\Controllers\Admin\CommentController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [App\Http\Controllers\Admin\CommentController::class, 'update'])->name('update');
            Route::get('/destroy/{id}', [App\Http\Controllers\Admin\CommentController::class, 'destroy'])->name('destroy');
            Route::get('/status/{id}', [App\Http\Controllers\Admin\CommentController::class, 'status'])->name('status');
        });
    });
});
