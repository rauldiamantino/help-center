<?php

use App\Livewire\Articles\ArticleList;
use App\Livewire\Articles\ArticlesManager;
use App\Livewire\Articles\ShowArticle;
use Illuminate\Support\Facades\Route;

// Authentication
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/articles', ArticlesManager::class)->name('articles');
