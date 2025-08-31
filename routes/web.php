<?php

use App\Livewire\Dashboard\Index;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Livewire\Dashboard\Articles\EditArticle;
use App\Livewire\Dashboard\Articles\ShowArticle;
use App\Livewire\Dashboard\Articles\ListArticles;
use App\Livewire\Dashboard\Articles\CreateArticle;
use App\Livewire\Dashboard\Categories\EditCategory;
use App\Livewire\Dashboard\Categories\CreateCategory;
use App\Livewire\Dashboard\Categories\ListCategories;

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
    Route::get('/articles/create', CreateArticle::class)->name('articles.create');
    Route::get('/articles/{articleNumber}', ShowArticle::class)->name('articles.show');
    Route::get('/articles/{articleNumber}/edit', EditArticle::class)->name('articles.edit');
    Route::get('/categories', ListCategories::class)->name('categories.index');
    Route::get('/categories/create', CreateCategory::class)->name('categories.create');
    Route::get('/categories/{categoryNumber}/edit', EditCategory::class)->name('categories.edit');
    Route::post('/upload', [UploadController::class, 'upload']);

});
