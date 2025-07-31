<?php

use App\Http\Controllers\Web\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/change-language/{lang}', [HomeController::class, 'changeLanguage'])->name('change.language');
Route::get('quran', [HomeController::class, 'quran'])->name('quran.index');
Route::get('quran/{id}', [HomeController::class, 'quranChapter'])->name('quran.chapter');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
