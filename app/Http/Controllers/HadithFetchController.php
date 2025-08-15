<?php
namespace App\Http\Controllers;

use App\Models\HadithBookTranslation;
use App\Models\HadithChapter;
use App\Models\HadithVerse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HadithFetchController extends Controller
{
    public function books(Request $request)
    {
        $books = HadithBookTranslation::select(['hadith_book_id', 'name'])
            ->where('name', 'like', '%' . $request->q . '%')
            ->lang('en')
            ->active()
            ->get();

        return response()->json($books);
    }

    public function chapters(Request $request)
    {
        $chapters = HadithChapter::select(['id', 'chapter_number', 'name'])
            ->with([
                'translations' => fn($q) => $q
                    ->select(['id', 'hadith_chapter_id', 'name'])
                    ->when(! empty($request->q) && ! is_numeric($request->q), fn($q) => $q->where('name', 'like', '%' . $request->q . '%'))
                    ->active()
                    ->lang('en'),
            ])
            ->when(! empty($request->q), function ($q) use ($request) {
                $q->where(function ($query) use ($request) {
                    $query->whereHas('translations', fn($q) => $q->where('name', 'like', '%' . $request->q . '%'));

                    if (is_numeric($request->q)) {
                        $query->orWhere('chapter_number', $request->q);
                    }
                });
            })
            ->where('hadith_book_id', $request->hadith_book_id)
            ->active()
            ->get();

        return response()->json($chapters);
    }

    public function verses(Request $request)
    {
        $verses = HadithVerse::select(['id', 'hadith_number', 'text'])
        // ->with([
        //     'translations' => fn($q) => $q
        //         ->select(['id', 'hadith_verse_id', 'text'])
        //         ->when(! empty($request->q) && ! is_numeric($request->q), fn($q) => $q->where('text', 'like', '%' . $request->q . '%'))
        //         ->active()
        //         ->lang('en'),
        // ])
            ->when(! empty($request->q), function ($q) use ($request) {
                $q->where(function ($query) use ($request) {
                    //$query->whereHas('translations', fn($q) => $q->where('text', 'like', '%' . $request->q . '%'));

                    if (is_numeric($request->q)) {
                        $query->orWhere('hadith_number', $request->q);
                    }
                });
            })
            ->where('hadith_chapter_id', $request->hadith_chapter_id)
            ->active()
            ->get();

        return response()->json($verses);
    }

    public function verse($id)
    {
        $result = HadithVerse::select('id', 'hadith_book_id', 'hadith_chapter_id', 'chapter_number', 'hadith_number', 'heading', 'text', 'volume', 'status')
            ->with([
                'translations',
                'chapter' => fn($q) => $q->select('id', 'hadith_book_id', 'chapter_number', 'name')->with('translations'),
                'book'    => fn($q)    => $q->select('id', 'name', 'slug', 'writer', 'writer_death_year', 'hadith_count', 'chapter_count')->with('translations'),
            ])
            ->where('id', $id)
            ->active()
            ->get();

        return response()->json(['html' => view('web.partials.hadith-list', ['result' => $result, 'action' => false])->render()]);
    }

    public function likes(Request $request)
    {
        $ids = Auth::check() && Auth::user()->role == 'Customer'
        ? Auth::user()->likes()->where('likeable_type', 'App\Models\HadithVerse')->pluck('likeable_id')->toArray()
        : array_values(array_filter($request->ids));

        $result = HadithVerse::select('id', 'hadith_book_id', 'hadith_chapter_id', 'chapter_number', 'hadith_number', 'heading', 'text', 'volume', 'status')
            ->with([
                'translations',
                'chapter' => fn($q) => $q->select('id', 'hadith_book_id', 'chapter_number', 'name')->with('translations'),
                'book'    => fn($q)    => $q->select('id', 'name', 'slug', 'writer', 'writer_death_year', 'hadith_count', 'chapter_count')->with('translations'),
            ])
            ->whereIn('id', $ids)
            ->active()
            ->paginate(5);

        return response()->json([
            'html'       => view('web.partials.hadith-list', ['result' => $result, 'liked' => true])->render(),
            'pagination' => view('components.web.pagination', ['paginator' => $result])->render(),
        ]);
    }

    public function bookmarks(Request $request)
    {
        $ids = Auth::user()->bookmarks()->where('bookmarkable_type', 'App\Models\HadithVerse')
            ->where('bookmark_collection_id', $request->collection_id)->pluck('bookmarkable_id')->toArray();

        $result = HadithVerse::select('id', 'hadith_book_id', 'hadith_chapter_id', 'chapter_number', 'hadith_number', 'heading', 'text', 'volume', 'status')
            ->with([
                'translations',
                'chapter' => fn($q) => $q->select('id', 'hadith_book_id', 'chapter_number', 'name')->with('translations'),
                'book'    => fn($q)    => $q->select('id', 'name', 'slug', 'writer', 'writer_death_year', 'hadith_count', 'chapter_count')->with('translations'),
            ])
            ->whereIn('id', $ids)
            ->active()
            ->paginate(5);

        return response()->json([
            'html'       => view('web.partials.hadith-list', ['result' => $result, 'bookmarked' => true])->render(),
            'pagination' => view('components.web.pagination', ['paginator' => $result])->render(),
        ]);
    }
}
