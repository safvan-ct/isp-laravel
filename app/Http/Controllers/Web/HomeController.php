<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
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
}
