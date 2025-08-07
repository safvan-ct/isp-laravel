<?php

use App\Http\Controllers\HadithFetchController;
use App\Http\Controllers\QuranFetchController;
use App\Http\Controllers\Web\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/change-language/{lang}', [HomeController::class, 'changeLanguage'])->name('change.language');

Route::get('quran', [HomeController::class, 'quran'])->name('quran.index');
Route::get('quran/{id}', [HomeController::class, 'quranChapter'])->name('quran.chapter');

Route::get('hadith', [HomeController::class, 'hadith'])->name('hadith.index');
Route::get('hadith/{book}/chapters', [HomeController::class, 'hadithChapters'])->name('hadith.chapters');
Route::get('hadith/chapter/{chapter}', [HomeController::class, 'hadithChapterVerses'])->name('hadith.chapter.verses');
Route::get('hadith/{book}/verses/{verse}', [HomeController::class, 'hadithVerseByNumber'])->name('hadith.book.verse');

Route::get('modules/{slug}/show', [HomeController::class, 'modules'])->name('modules.show');
Route::get('questions/{module_id}', [HomeController::class, 'questions'])->name('questions');
Route::get('answers/{question_id}', [HomeController::class, 'answers'])->name('answers');

// Fetch
Route::get('fetch-quran-chapters', [QuranFetchController::class, 'chapters'])->name('fetch.quran.chapters');
Route::get('fetch-quran-ayahs', [QuranFetchController::class, 'verses'])->name('fetch.quran.ayahs');
Route::get('fetch-quran-verse/{id}', [QuranFetchController::class, 'verse'])->name('fetch.quran.verse');

Route::get('fetch-hadith-books', [HadithFetchController::class, 'books'])->name('fetch.hadith.books');
Route::get('fetch-hadith-chapters', [HadithFetchController::class, 'chapters'])->name('fetch.hadith.chapters');
Route::get('fetch-hadith-verses', [HadithFetchController::class, 'verses'])->name('fetch.hadith.verses');
Route::get('fetch-hadith-verse/{id}', [HadithFetchController::class, 'verse'])->name('fetch.hadith.verse');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
