<?php
namespace App\Http\Controllers;

use App\Models\QuranChapterTranslation;
use App\Models\QuranVerse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuranFetchController extends Controller
{
    public function chapters(Request $request)
    {
        $chapterId = $request->q;

        $chapters = QuranChapterTranslation::select(['quran_chapter_id', 'name'])
            ->lang('en')
            ->where('quran_chapter_id', $chapterId)
            ->active()
            ->get();

        return response()->json($chapters);
    }

    public function verses(Request $request)
    {
        $chapterId  = $request->get('chapter_id');
        $ayahNumber = $request->get('q', '');

        $chapters = QuranVerse::select(['id', 'number_in_chapter', 'text'])
            ->where('quran_chapter_id', $chapterId)
            ->when($ayahNumber, fn($q) => $q->where('number_in_chapter', $ayahNumber))
            ->active()
            ->get();

        return response()->json($chapters);
    }

    public function verse($id)
    {
        $verse = QuranVerse::select('id', 'quran_chapter_id', 'number_in_chapter', 'text')
            ->with([
                'translations',
                'chapter' => fn($q) => $q->select('id', 'name')->with('translations'),
            ])
            ->where('id', $id)
            ->active()
            ->first();

        return response()->json($verse);
    }

    public function likes(Request $request)
    {
        $ids = Auth::check() && Auth::user()->role == 'Customer'
        ? Auth::user()->likes()->where('likeable_type', 'App\Models\QuranVerse')->pluck('likeable_id')->toArray()
        : array_values(array_filter($request->ids));

        $verse = QuranVerse::select('id', 'quran_chapter_id', 'number_in_chapter', 'text')
            ->with([
                'translations',
                'chapter' => fn($q) => $q->select('id', 'name')->with('translations'),
            ])
            ->whereIn('id', $ids)
            ->active()
            ->paginate(5);

        return response()->json([
            'data' => $verse->items(),
            'meta' => [
                'current_page' => $verse->currentPage(),
                'last_page'    => $verse->lastPage(),
                'per_page'     => $verse->perPage(),
                'total'        => $verse->total(),
            ],
        ]);
    }
}
