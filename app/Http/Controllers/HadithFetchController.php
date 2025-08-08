<?php
namespace App\Http\Controllers;

use App\Models\HadithBookTranslation;
use App\Models\HadithChapter;
use App\Models\HadithVerse;
use Illuminate\Http\Request;

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
        $verse = HadithVerse::select(['id', 'hadith_book_id', 'hadith_chapter_id', 'chapter_number', 'hadith_number', 'heading', 'text', 'volume', 'status'])
            ->with([
                'translations' => fn($q) => $q
                    ->select('id', 'hadith_verse_id', 'lang', 'heading', 'text')
                    ->active()
                    ->lang('en'),

                'chapter'      => fn($q)      => $q
                    ->select('id', 'hadith_book_id', 'chapter_number', 'name')
                    ->with([
                        'translations' => fn($q) => $q->select('id', 'hadith_chapter_id', 'name')
                            ->active()
                            ->lang(),
                    ]),

                'book'         => fn($q)         => $q
                    ->select('id', 'name', 'slug', 'writer', 'writer_death_year', 'hadith_count', 'chapter_count')
                    ->with([
                        'translations' => fn($q) => $q->select('id', 'hadith_book_id', 'name', 'writer')
                            ->active()
                            ->lang(),
                    ]),
            ])
            ->where('id', $id)
            ->active()
            ->first();

        return response()->json($verse);
    }
}
