<?php

use App\Models\ProjectOrder;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectOrderController;
use App\Http\Controllers\ProjectToolController;
use App\Http\Controllers\ProjectSchrenshootController;
use App\Http\Controllers\TestimonialController;

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/details/{project:slug}', [FrontController::class, 'details'])->name('front.details');
Route::get('/book', [FrontController::class, 'book'])->name('front.book');
Route::post('/book/save', [FrontController::class, 'store'])->name('front.book.store');
Route::get('/services', [FrontController::class, 'services'])->name('front.services');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::prefix('admin')->name('admin.')->group(function(){
        Route::resource('project',ProjectController::class);
        Route::resource('tools',ToolController::class);
        Route::resource('project_tools',ProjectToolController::class);
        Route::resource('project_order',ProjectOrderController::class);
        Route::resource('testimonial',TestimonialController::class);
     
        Route::get('/tools/assign/{project}', [ProjectToolController::class, 'create'])->name('project-assign-tool');
        Route::post('/tools/assign/save/{project}', [ProjectToolController::class, 'store'])->name('project-assign-tool.store');

        Route::resource('project_schrenshoot',ProjectSchrenshootController::class);
        Route::get('/schrenshoot/{project}', [ProjectSchrenshootController::class, 'create'])->name('project_schrenshoot.create');


        Route::post('/schrenshoot/save/{project}', [ProjectSchrenshootController::class, 'store'])->name('project_schrenshoot.store');


    });
   


});

require __DIR__.'/auth.php';
