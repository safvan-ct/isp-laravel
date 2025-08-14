<?php

use App\Http\Controllers\HadithFetchController;
use App\Http\Controllers\QuranFetchController;
use App\Http\Controllers\Web\BookmarkCollectionController;
use App\Http\Controllers\Web\HadithController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LikeController;
use App\Http\Controllers\Web\QuranController;
use App\Http\Controllers\Web\SyncController;
use App\Http\Controllers\Web\TopicController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/admin.php';
require __DIR__ . '/auth.php';

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/change-language/{lang}', [HomeController::class, 'changeLanguage'])->name('change.language');

// Fetch
Route::prefix('fetch')->name('fetch.')->group(function () {
    Route::get('quran-chapters', [QuranFetchController::class, 'chapters'])->name('quran.chapters');
    Route::get('quran-ayahs', [QuranFetchController::class, 'verses'])->name('quran.ayahs');
    Route::get('quran-verse/{id}', [QuranFetchController::class, 'verse'])->name('quran.verse');
    Route::post('quran-like', [QuranFetchController::class, 'likes'])->name('quran.like');
    Route::post('quran-bookmark', [QuranFetchController::class, 'bookmarks'])->name('quran.bookmark');

    Route::get('hadith-books', [HadithFetchController::class, 'books'])->name('hadith.books');
    Route::get('hadith-chapters', [HadithFetchController::class, 'chapters'])->name('hadith.chapters');
    Route::get('hadith-verses', [HadithFetchController::class, 'verses'])->name('hadith.verses');
    Route::get('hadith-verse/{id}', [HadithFetchController::class, 'verse'])->name('hadith.verse');
    Route::post('hadith-like', [HadithFetchController::class, 'likes'])->name('hadith.like');
    Route::post('hadith-bookmark', [HadithFetchController::class, 'bookmarks'])->name('hadith.bookmark');

    Route::post('topic-like', [HomeController::class, 'likes'])->name('topic.like');
    Route::post('topic-bookmark', [HomeController::class, 'bookmarks'])->name('topic.bookmark');
    Route::get('collections', [HomeController::class, 'collections'])->name('collections')->middleware('auth');
});
// End Fetch

Route::middleware(['auth'])->group(function () {
    Route::resource('collections', BookmarkCollectionController::class)
        ->only(['update', 'destroy']); // We won't use separate create/edit pages
});

Route::get('calendar', [HomeController::class, 'calendar'])->name('calendar');
Route::get('likes', [QuranController::class, 'likes'])->name('likes');
Route::get('collections', [QuranController::class, 'collections'])->name('bookmarks')->middleware('auth');
Route::get('collection/{id}', [QuranController::class, 'collection'])->name('collection')->middleware('auth');

Route::post('sync-data', [SyncController::class, 'store'])->name('sync.data')->middleware('auth');
Route::post('like-item', [LikeController::class, 'store'])->name('like.toggle')->middleware('auth');
Route::post('bookmark-item', [LikeController::class, 'bookmark'])->name('bookmark.toggle')->middleware('auth');
Route::post('collection', [LikeController::class, 'collection'])->name('collection.store')->middleware('auth');

Route::get('quran', [QuranController::class, 'quran'])->name('quran.index');
Route::get('quran/{id}', [QuranController::class, 'quranChapter'])->name('quran.chapter');

Route::get('hadith', [HadithController::class, 'hadith'])->name('hadith.index');
Route::get('hadith/{book}/chapters', [HadithController::class, 'hadithChapters'])->name('hadith.chapters');
Route::get('hadith/{book}/chapter/{chapter}', [HadithController::class, 'hadithChapterVerses'])->name('hadith.chapter.verses');
Route::get('hadith/{book}/verse/{verse}', [HadithController::class, 'hadithVerseByNumber'])->name('hadith.book.verse');

Route::get('{slug}', [TopicController::class, 'modules'])->name('modules.show');
Route::get('{menu_slug}/{module_slug}', [TopicController::class, 'questions'])->name('questions.show');
Route::get('{menu_slug}/{module_slug}/{question_slug}', [TopicController::class, 'answers'])->name('answers.show');
