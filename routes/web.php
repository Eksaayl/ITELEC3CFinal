<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\PinterestController;
use Illuminate\Support\Facades\Route;

// Public routes (Guest side)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/inspiration', function () {
    return view('inspiration');
})->name('inspiration');

Route::get('/pro', function () {
    return view('pro');
})->name('pro');

Route::get('/designer', function () {
    return view('designer');
})->name('designer');

Route::get('/job-post', function () {
    return view('job-post');
})->name('job-post');

Route::get('/testing', function () {
    return view('testing');
})->name('testing');

// Guest route for the Test page
Route::get('/test', [PinterestController::class, 'index'])->name('test');

// Authenticated routes (Admin side)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'isAdmin:admin'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/manage-job', function () {
        return view('manage-job');
    })->name('manage-job');

    Route::get('/manage-design', function () {
        return view('manage-design');
    })->name('manage-design');

    Route::get('/manage-post', [PostController::class, 'index'])->name('manage-post');
    Route::get('/posts-create', [PostController::class, 'create'])->name('posts-create');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
});

// Post routes
Route::get('/inspiration', [PostController::class, 'index2'])->name('inspiration');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::post('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('users.show');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');


Route::post('/pictures/{id}/comments', [PinterestController::class, 'addComment'])->middleware('auth');
Route::post('/pictures/{id}/comments', [PinterestController::class, 'addComment'])
    ->name('test.addComment')
    ->middleware('auth');

    Route::delete('/comments/{id}', [PinterestController::class, 'deleteComment'])
    ->name('test.deleteComment')
    ->middleware('auth');


Route::post('/pictures', [PinterestController::class, 'store'])->name('test.store');
Route::put('/pictures/{id}', [PinterestController::class, 'update'])->name('test.update');
Route::delete('/pictures/{id}', [PinterestController::class, 'destroy'])->name('test.destroy');

// Static form view
Route::get('/form', function () {
    return view('form');
})->name('form');
