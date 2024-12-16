<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'isAdmin:admin'
])->group(function () {
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/manage-job', function () {
        return view('manage-job');
    })->name('manage-job');

    Route::get('/manage-design', function () {
        return view('manage-design');
    })->name('manage-design');

    
    Route::get('/manage-post', [PostController::class, 'index'])->name('manage-post');  // list posts view
    Route::get('/posts-create', [PostController::class, 'create'])->name('posts-create'); // create post view
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit'); // edit post view
});

    Route::get('/inspiration', [PostController::class, 'index2'])->name('/inspiration');  // list posts view
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store'); // store new post
    Route::post('/posts/{id}', [PostController::class, 'update'])->name('posts.update'); // update existing post
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('users.show'); // indiv post view
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy'); // delete post
 


// Static form view
Route::get('/form', function () {
    return view('form');
})->name('form');
