<?php

use App\Http\Controllers\FetchTopicController;
use App\Http\Controllers\HadithFetchController;
use App\Http\Controllers\QuranFetchController;
use App\Http\Controllers\Web\BookmarkCollectionController;
use App\Http\Controllers\Web\BookmarkController;
use App\Http\Controllers\Web\HadithController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LikeController;
use App\Http\Controllers\Web\QuranController;
use App\Http\Controllers\Web\SyncController;
use App\Http\Controllers\Web\TopicController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/admin.php';
require __DIR__ . '/auth.php';

Route::get('change-language/{lang}', [HomeController::class, 'changeLanguage'])->name('change.language');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('calendar', [HomeController::class, 'calendar'])->name('calendar');
Route::get('likes', [HomeController::class, 'likes'])->name('likes');

// Fetch
Route::prefix('fetch')->name('fetch.')->group(function () {
    Route::get('quran-chapters', [QuranFetchController::class, 'fetchChapters'])->name('quran.chapters');
    Route::get('quran-ayahs', [QuranFetchController::class, 'fetchVerses'])->name('quran.ayahs');
    Route::get('quran-verse/{id}', [QuranFetchController::class, 'fetchVerseById'])->name('quran.verse');
    Route::post('quran-like', [QuranFetchController::class, 'fetchLikedVerses'])->name('quran.like');
    Route::post('quran-bookmark', [QuranFetchController::class, 'fetchBookmarkedVerses'])->name('quran.bookmark');

    Route::get('hadith-books', [HadithFetchController::class, 'fetchBooks'])->name('hadith.books');
    Route::get('hadith-chapters', [HadithFetchController::class, 'fetchChapters'])->name('hadith.chapters');
    Route::get('hadith-verses', [HadithFetchController::class, 'fetchVerses'])->name('hadith.verses');
    Route::get('hadith-verse/{id}', [HadithFetchController::class, 'fetchVerse'])->name('hadith.verse');
    Route::post('hadith-like', [HadithFetchController::class, 'fetchLikedVerses'])->name('hadith.like');
    Route::post('hadith-bookmark', [HadithFetchController::class, 'fetchBookmarkedVerses'])->name('hadith.bookmark');

    Route::post('topic-like', [FetchTopicController::class, 'fetchLikedTopics'])->name('topic.like');
    Route::post('topic-bookmark', [FetchTopicController::class, 'fetchBookmarkedTopics'])->name('topic.bookmark');
});
// End Fetch

Route::middleware(['auth'])->group(function () {
    Route::post('like-item', [LikeController::class, 'store'])->name('like.toggle');
    Route::post('bookmark-item', [BookmarkController::class, 'store'])->name('bookmark.toggle');

    Route::get('fetch/collections', [BookmarkCollectionController::class, 'fetchCollections'])->name('fetch.collections');
    Route::resource('collections', BookmarkCollectionController::class)->except(['create', 'edit']);
});

Route::post('sync-data', [SyncController::class, 'store'])->name('sync.data')->middleware('auth');

Route::get('quran', [QuranController::class, 'quran'])->name('quran.index');
Route::get('quran/{id}', [QuranController::class, 'quranChapter'])->name('quran.chapter');

Route::get('hadith', [HadithController::class, 'hadith'])->name('hadith.index');
Route::get('hadith/{book}/chapters', [HadithController::class, 'hadithChapters'])->name('hadith.chapters');
Route::get('hadith/{book}/chapter/{chapter}', [HadithController::class, 'hadithChapterVerses'])->name('hadith.chapter.verses');
Route::get('hadith/{book}/verse/{verse}', [HadithController::class, 'hadithVerseByNumber'])->name('hadith.book.verse');

Route::get('{slug}', [TopicController::class, 'modules'])->name('modules.show');
Route::get('{menu_slug}/{module_slug}', [TopicController::class, 'questions'])->name('questions.show');
Route::get('{menu_slug}/{module_slug}/{question_slug}', [TopicController::class, 'answers'])->name('answers.show');
