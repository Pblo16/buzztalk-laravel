<?php

use App\Livewire\Pages\Chat;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('video');
})->name('video');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('video');
    });
    Route::get('/chats', function () {
        return view('chat');
    })->middleware(['auth'])->name('chat');
});
