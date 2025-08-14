<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\BookmarkCollection;
use App\Models\Topic;
use App\Repository\Topic\TopicInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $ids = Auth::check() && Auth::user()->role == 'Customer'
        ? Auth::user()->likes()->where('likeable_type', 'App\Models\Topic')->pluck('likeable_id')->toArray()
        : array_values(array_filter($request->ids));

        $verse = Topic::select('id', 'slug', 'parent_id')
            ->withWhereHas('translations')
            ->with([
                'parent.translations',
                'parent.parent.translations',
                'parent.parent.parent.translations',
            ])
            ->where('type', 'answer')
            ->whereIn('id', $ids)
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

    public function bookmarks(Request $request)
    {
        $ids = Auth::user()->bookmarks()->where('bookmarkable_type', 'App\Models\Topic')
            ->where('bookmark_collection_id', $request->collection_id)->pluck('bookmarkable_id')->toArray();

        $verse = Topic::select('id', 'slug', 'parent_id')
            ->withWhereHas('translations')
            ->with([
                'parent.translations',
                'parent.parent.translations',
                'parent.parent.parent.translations',
            ])
            ->where('type', 'answer')
            ->whereIn('id', $ids)
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

    public function collections(Request $request)
    {
        $result = BookmarkCollection::select('id', 'name')
            ->with('items:id,bookmark_collection_id,bookmarkable_id,bookmarkable_type')
            ->where('user_id', Auth::user()->id)
            ->orderBy('name', 'asc')
            ->get();

        return response()->json($result);
    }
}
