<?php
namespace App\Http\Controllers;

use App\Models\QuranChapterTranslation;
use App\Models\QuranVerse;
use Illuminate\Http\Request;

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
        $ids   = array_values(array_filter($request->ids));
        $verse = QuranVerse::select('id', 'quran_chapter_id', 'number_in_chapter', 'text')
            ->with([
                'translations',
                'chapter' => fn($q) => $q->select('id', 'name')->with('translations'),
            ])
            ->whereIn('id', $ids)
            ->active()
            ->get();

        return response()->json($verse);
    }
}
