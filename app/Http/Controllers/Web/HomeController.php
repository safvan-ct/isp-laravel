<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Repository\Topic\TopicInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(protected TopicInterface $topicRepository)
    {}

    public function changeLanguage($lang)
    {
        if (in_array($lang, array_keys(config('app.languages')))) {
            session()->put('lang', $lang);
            app()->setLocale(session('lang', 'en'));
        }

        return redirect()->back();
    }

    public function index()
    {
        $modules = $this->topicRepository->getModulesHasMenu();
        return view('web.index', compact('modules'));
    }

    public function calendar()
    {
        return view('web.calendar');
    }

    public function likes(Request $request)
    {
        $ids = array_values(array_filter($request->ids));

        $verse = Topic::select('id', 'slug', 'parent_id')
            ->withWhereHas('translations')
            ->with([
                'parent.translations',
                'parent.parent.translations',
                'parent.parent.parent.translations',
            ])
            ->where('type', 'answer')
            ->whereIn('id', $ids)
            ->get();

        return response()->json($verse);
    }
}
