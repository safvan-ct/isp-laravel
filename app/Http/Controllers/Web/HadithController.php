<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repository\Hadith\HadithBookInterface;
use App\Repository\Hadith\HadithChapterInterface;
use App\Repository\Hadith\HadithVerseInterface;

class HadithController extends Controller
{
    public function __construct(
        protected HadithBookInterface $hadithBookRepository,
        protected HadithChapterInterface $hadithChapterRepository,
        protected HadithVerseInterface $hadithVerseRepository
    ) {}

    public function hadith()
    {
        $books = $this->hadithBookRepository->getWithTranslations();
        return view('web.hadith-books', compact('books'));
    }

    public function hadithChapters($bookId)
    {
        $book = $this->hadithBookRepository->getWithChapters($bookId);
        return view('web.hadith-chapters', compact('book'));
    }

    public function hadithChapterVerses($bookSlug, $chapterId)
    {
        $chapter = $this->hadithChapterRepository->getWithAll($chapterId);
        if (! $chapter) {
            abort(404);
        }

        return view('web.hadith-verses', compact('chapter'));
    }

    public function hadithVerseByNumber($bookId, $verseNumber)
    {
        $hadithVerse = $this->hadithVerseRepository->getByWhere([
            'hadith_number'  => $verseNumber,
            'hadith_book_id' => $bookId,
        ]);
        if (! $hadithVerse) {
            abort(404);
        }

        $chapter = $this->hadithChapterRepository->getWithAll($hadithVerse->hadith_chapter_id, $verseNumber);
        if (! $chapter) {
            abort(404);
        }

        return view('web.hadith-verses', compact('chapter', 'verseNumber'));
    }
}
