<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\QuranChapter;

class HomeController extends Controller
{
    public function index()
    {
        return view('web.index');
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

        return view('web.quran-chapter', compact('chapter'));
    }
}
