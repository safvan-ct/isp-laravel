<?php

use App\Http\Controllers\HadithFetchController;
use App\Http\Controllers\QuranFetchController;
use App\Http\Controllers\Web\HadithController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\QuranController;
use App\Http\Controllers\Web\TopicController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/change-language/{lang}', [HomeController::class, 'changeLanguage'])->name('change.language');

// Fetch
Route::prefix('fetch')->name('fetch.')->group(function () {
    Route::get('quran-chapters', [QuranFetchController::class, 'chapters'])->name('quran.chapters');
    Route::get('quran-ayahs', [QuranFetchController::class, 'verses'])->name('quran.ayahs');
    Route::get('quran-verse/{id}', [QuranFetchController::class, 'verse'])->name('quran.verse');

    Route::get('hadith-books', [HadithFetchController::class, 'books'])->name('hadith.books');
    Route::get('hadith-chapters', [HadithFetchController::class, 'chapters'])->name('hadith.chapters');
    Route::get('hadith-verses', [HadithFetchController::class, 'verses'])->name('hadith.verses');
    Route::get('hadith-verse/{id}', [HadithFetchController::class, 'verse'])->name('hadith.verse');
});
// End Fetch

Route::get('calendar', [HomeController::class, 'calendar'])->name('calendar');

Route::get('quran', [QuranController::class, 'quran'])->name('quran.index');
Route::get('quran/{id}', [QuranController::class, 'quranChapter'])->name('quran.chapter');

Route::get('hadith', [HadithController::class, 'hadith'])->name('hadith.index');
Route::get('hadith/{book}/chapters', [HadithController::class, 'hadithChapters'])->name('hadith.chapters');
Route::get('hadith/{book}/chapter/{chapter}', [HadithController::class, 'hadithChapterVerses'])->name('hadith.chapter.verses');
Route::get('hadith/{book}/verse/{verse}', [HadithController::class, 'hadithVerseByNumber'])->name('hadith.book.verse');

Route::get('{slug}', [TopicController::class, 'modules'])->name('modules.show');
Route::get('{menu_slug}/{module_slug}', [TopicController::class, 'questions'])->name('questions.show');
Route::get('{menu_slug}/{module_slug}/{question_slug}', [TopicController::class, 'answers'])->name('answers.show');
