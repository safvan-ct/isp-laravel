<?php

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

Route::get('fetch-quran-verse/{id}', [HomeController::class, 'fetchQuranVerse'])->name('fetch.quran.verse');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
