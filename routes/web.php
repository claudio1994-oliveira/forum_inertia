<?php

use App\Http\Controllers\DiscussionShowController;
use App\Http\Controllers\DiscussionStoreController;
use App\Http\Controllers\ForumIndexController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', ForumIndexController::class)->name('home');
Route::get('discussions/{discussion:slug}', DiscussionShowController::class)->name('discussion.show');

Route::middleware('auth')->group(function () {
    Route::post('discussions', DiscussionStoreController::class)->name('discussion.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
