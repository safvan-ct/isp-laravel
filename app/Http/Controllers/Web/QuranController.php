<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\BookmarkCollection;
use App\Repository\Quran\QuranChapterInterface;

class QuranController extends Controller
{
    public function __construct(
        protected QuranChapterInterface $quranChapterRepository,
    ) {}

    public function quran()
    {
        $chapters = $this->quranChapterRepository->getWithTranslations();
        return view('web.quran-chapters', compact('chapters'));
    }

    public function quranChapter($id)
    {
        $chapter = $this->quranChapterRepository->getWithVerses($id);
        if (! $chapter) {
            abort(404);
        }

        return view('web.quran-verses', compact('chapter'));
    }

    public function likes()
    {
        return view('web.likes');
    }

    public function collections()
    {
        $collections = BookmarkCollection::withCount('items')
            ->where('user_id', auth()->id())
            ->orderByDesc('items_count')
            ->paginate(9);

        return view('web.collections', compact('collections'));
    }

    public function collection($collectionId)
    {
        if (! $collection = BookmarkCollection::where('id', $collectionId)->where('user_id', auth()->id())->first()) {
            abort(404);
        }

        return view('web.collection', compact('collection'));
    }
}
