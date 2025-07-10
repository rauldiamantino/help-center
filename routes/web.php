<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Articles\ListArticles;
use App\Livewire\Articles\ShowArticle;
use App\Livewire\Dashboard\Index;

// use App\Livewire\Articles\CreateArticle;
// use App\Livewire\Articles\EditArticle;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', Index::class)->name('index');
    Route::get('/articles', ListArticles::class)->name('articles.index');
    Route::get('/articles/{id}', ShowArticle::class)->name('articles.show');
    // Route::get('/articles/create', CreateArticle::class)->name('articles.create');
    // Route::get('/articles/{id}/edit', EditArticle::class)->name('articles.edit');
});
