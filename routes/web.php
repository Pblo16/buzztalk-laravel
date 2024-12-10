<?php

use App\Livewire\Friends\FriendRequest;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

// Move broadcast routes to root scope and remove duplicate
Broadcast::routes(['middleware' => ['web', 'auth:sanctum']]);

Route::get('/', function () {
    return view('video');
})->name('video');

Route::get('/websocket-test', function () {
    return view('websocket-test');
})->name('websocket-test');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('video');
    });
    Route::get('/chats', function () {
        return view('chats');
    })->middleware(['auth'])->name('chats');

    Route::get('/friend-requests', function () {
        return view('friends');
    })->middleware(['auth'])->name('friends');

    Route::get('/profile/{username?}', function ($username = null) {
        return view('profile', ['username' => $username]);
    })->middleware(['auth'])->name('profile.index');

    Route::get('/upload-post', function () {
        return view('post');
    })->middleware(['auth'])->name('post.upload');

    Route::get('/feed', function () {
        return view('feed');
    })->middleware(['auth'])->name('post.feed');
});
