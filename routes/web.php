<?php

use App\Http\Controllers\HadithFetchController;
use App\Http\Controllers\QuranFetchController;
use App\Http\Controllers\Web\HadithController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\QuranController;
use App\Http\Controllers\Web\TopicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/change-language/{lang}', [HomeController::class, 'changeLanguage'])->name('change.language');

Route::get('quran', [QuranController::class, 'quran'])->name('quran.index');
Route::get('quran/{id}', [QuranController::class, 'quranChapter'])->name('quran.chapter');

Route::get('hadith', [HadithController::class, 'hadith'])->name('hadith.index');
Route::get('hadith/{book}/chapters', [HadithController::class, 'hadithChapters'])->name('hadith.chapters');
Route::get('hadith/{book}/chapter/{chapter}', [HadithController::class, 'hadithChapterVerses'])->name('hadith.chapter.verses');
Route::get('hadith/{book}/verse/{verse}', [HadithController::class, 'hadithVerseByNumber'])->name('hadith.book.verse');

Route::get('{slug}', [TopicController::class, 'modules'])->name('modules.show');
Route::get('{menu_slug}/{module_slug}', [TopicController::class, 'questions'])->name('questions.show');
Route::get('{menu_slug}/{module_slug}/{question_slug}', [TopicController::class, 'answers'])->name('answers.show');

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
