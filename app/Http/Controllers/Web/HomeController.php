<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\HadithBook;
use App\Models\HadithChapter;
use App\Models\HadithVerse;
use App\Models\QuranChapter;
use App\Models\Topic;

class HomeController extends Controller
{
    public function index()
    {
        $modules = Topic::select('id', 'slug')
            ->withWhereHas('translations')
            ->withWhereHas('parent.translations')
            ->where('type', 'module')
            ->where('is_primary', 1)
            ->whereNotNull('parent_id')
            ->get();

        return view('web.index', compact('modules'));
    }

    public function changeLanguage($lang)
    {
        if (in_array($lang, array_keys(config('app.languages')))) {
            session()->put('lang', $lang);
            app()->setLocale(session('lang', 'en'));
        }

        return redirect()->back();
    }

    public function quran()
    {
        $chapters = QuranChapter::select(['id', 'name'])
            ->with([
                'translations' => fn($q) => $q
                    ->select(['id', 'quran_chapter_id', 'name'])
                    ->active()
                    ->lang(),
            ])
            ->active()
            ->get();

        return view('web.quran-chapters', compact('chapters'));
    }

    public function quranChapter($id)
    {
        $chapter = QuranChapter::select(['id', 'name', 'no_of_verses'])
            ->with([
                'translations' => fn($q) => $q
                    ->select(['id', 'quran_chapter_id', 'name', 'translation'])
                    ->active()
                    ->lang(),

                'verses'       => fn($q)       => $q
                    ->select(['id', 'quran_chapter_id', 'number_in_chapter', 'text'])
                    ->with(['translations' => fn($q) => $q
                            ->select(['id', 'quran_verse_id', 'text'])
                            ->active()
                            ->lang(),
                    ])
                    ->active(),
            ])
            ->whereHas('verses', fn($q) => $q->active())
            ->active()
            ->find($id);

        if (! $chapter) {
            abort(404);
        }

        return view('web.quran-verses', compact('chapter'));
    }

    public function hadith()
    {
        $books = HadithBook::select(['id', 'name', 'slug', 'writer', 'writer_death_year', 'chapter_count', 'hadith_count'])
            ->with([
                'translations' => fn($q) => $q
                    ->select(['id', 'hadith_book_id', 'name', 'writer'])
                    ->active()
                    ->lang(),
            ])
            ->active()
            ->get();

        return view('web.hadith-books', compact('books'));
    }

    public function hadithChapters($bookId)
    {
        $book = HadithBook::select(['id', 'name', 'writer'])
            ->with([
                'translations' => fn($q) => $q
                    ->select(['id', 'hadith_book_id', 'name', 'writer'])
                    ->active()
                    ->lang(),

                'chapters'     => fn($q)     => $q
                    ->select(['id', 'hadith_book_id', 'chapter_number', 'name'])
                    ->with(['translations' => fn($q) => $q
                            ->select(['id', 'hadith_chapter_id', 'name'])
                            ->active()
                            ->lang(),
                    ])
                    ->active(),
            ])
            ->active()
            ->find($bookId);

        return view('web.hadith-chapters', compact('book'));
    }

    public function hadithChapterVerses($chapterId)
    {
        $chapter = HadithChapter::select(['id', 'hadith_book_id', 'name', 'chapter_number'])
            ->with([
                'translations' => fn($q) => $q
                    ->select(['id', 'hadith_chapter_id', 'name'])
                    ->active()
                    ->lang(),

                'verses'       => fn($q)       => $q
                    ->select(['id', 'hadith_chapter_id', 'heading', 'text', 'chapter_number', 'hadith_number', 'heading', 'text', 'volume', 'status'])
                    ->with(['translations' => fn($q) => $q
                            ->select(['id', 'hadith_verse_id', 'heading', 'text'])
                            ->active()
                            ->lang('en'),
                    ])
                    ->active(),

                'book'         => fn($q)         => $q
                    ->select(['id', 'name', 'writer', 'writer_death_year', 'hadith_count', 'chapter_count'])
                    ->with(['translations' => fn($q) => $q
                            ->select(['id', 'hadith_book_id', 'name', 'writer'])
                            ->active()
                            ->lang(),
                    ])
                    ->active(),
            ])
            ->whereHas('verses', fn($q) => $q->active())
            ->active()
            ->find($chapterId);

        if (! $chapter) {
            abort(404);
        }

        return view('web.hadith-verses', compact('chapter'));
    }

    public function hadithVerseByNumber($bookId, $verseNumber)
    {
        $hadithVerse = HadithVerse::where('hadith_number', $verseNumber)
            ->where('hadith_book_id', $bookId)
            ->first();

        if (! $hadithVerse) {
            abort(404);
        }

        $chapter = HadithChapter::select(['id', 'hadith_book_id', 'name', 'chapter_number'])
            ->with([
                'translations' => fn($q) => $q
                    ->select(['id', 'hadith_chapter_id', 'name'])
                    ->active()
                    ->lang(),

                'verses'       => fn($q)       => $q
                    ->select(['id', 'hadith_chapter_id', 'heading', 'text', 'chapter_number', 'hadith_number', 'heading', 'text', 'volume', 'status'])
                    ->with(['translations' => fn($q) => $q
                            ->select(['id', 'hadith_verse_id', 'heading', 'text'])
                            ->active()
                            ->lang(),
                    ])
                    ->where('hadith_number', $hadithVerse->hadith_number)
                    ->active(),

                'book'         => fn($q)         => $q
                    ->select(['id', 'name', 'writer', 'writer_death_year', 'hadith_count', 'chapter_count'])
                    ->with(['translations' => fn($q) => $q
                            ->select(['id', 'hadith_book_id', 'name', 'writer'])
                            ->active()
                            ->lang(),
                    ])
                    ->active(),
            ])
            ->whereHas('verses', fn($q) => $q->active()->where('hadith_number', $hadithVerse->hadith_number))
            ->active()
            ->find($hadithVerse->hadith_chapter_id);

        if (! $chapter) {
            abort(404);
        }

        return view('web.hadith-verses', compact('chapter', 'verseNumber'));
    }

    public function modules($slug)
    {
        $topic = Topic::select('id', 'slug')
            ->withWhereHas('translations')
            ->withWhereHas('children.translations')
            ->where('type', 'menu')
            ->whereNull('parent_id')
            ->first();

        if (! $topic) {
            abort(404);
        }

        return view('web.modules', compact('topic'));
    }

    public function questions($module_id)
    {
        $module = Topic::select('id', 'slug', 'parent_id')
            ->withWhereHas('translations')
            ->withWhereHas('parent.translations')
            ->withWhereHas('children.translations')
            ->where('type', 'module')
            ->where('id', $module_id)
            ->first();

        if (! $module) {
            abort(404);
        }

        return view('web.questions', compact('module'));
    }

    public function answers($question_id)
    {
        $question = Topic::select('id', 'slug', 'parent_id')
            ->withWhereHas('translations')
            ->withWhereHas('parent.translations')
            ->withWhereHas('children.translations')
            ->with([
                'children.quranVerses',
                'children.hadithVerses',
                'children.videos',
            ])
            ->where('type', 'question')
            ->where('id', $question_id)
            ->active()
            ->first();

        if (! $question) {
            abort(404);
        }

        return view('web.answers', compact('question'));
    }
}
