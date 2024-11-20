<?php

use App\Models\Backend\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\MapController;
use App\Http\Controllers\Backend\EventController;
use App\Http\Controllers\Frontend\MenuController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RawMaterialController;
use App\Http\Controllers\Frontend\EventController as FrontendEventController;

Route::get('/', function () {
    return view('frontend.home');
});

Route::get('/tentang-kami', [AboutController::class, 'index'])->name('frontend.about');
Route::get('/layanan', [ServiceController::class, 'index'])->name('frontend.service');
Route::get('/acara', [FrontendEventController::class, 'index'])->name('frontend.event');
Route::get('/menu', [MenuController::class, 'index'])->name('frontend.menu');
Route::get('/hubungi', [ContactController::class, 'index'])->name('frontend.contact');
Route::get('/map', [MapController::class, 'index'])->name('frontend.map');

Route::prefix('panel')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('panel.dashboard.index');

    Route::resource('category', CategoryController::class)
        ->names('panel.category');

    Route::resource('raw-material', RawMaterialController::class)
        ->names('panel.raw-material');

    Route::resource('product', ProductController::class)
        ->names('panel.product');

    Route::resource('event', EventController::class)
        ->names('panel.event');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
