<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\BookmarkCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookmarkCollectionController extends Controller
{
    public function fetchCollections()
    {
        $result = BookmarkCollection::select('id', 'name')
            ->with('items:id,bookmark_collection_id,bookmarkable_id,bookmarkable_type')
            ->where('user_id', Auth::user()->id)
            ->orderBy('name', 'asc')
            ->get();

        return response()->json($result);
    }

    public function index()
    {
        $collections = BookmarkCollection::withCount('items')
            ->where('user_id', Auth::id())
            ->orderByDesc('items_count')
            ->paginate(9);

        return view('web.collections', compact('collections'));
    }

    public function show($collectionId)
    {
        if (! $collection = BookmarkCollection::where('id', $collectionId)->where('user_id', Auth::id())->first()) {
            abort(404);
        }

        return view('web.collection', compact('collection'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $collection       = BookmarkCollection::where('user_id', Auth::id())->findOrFail($id);
        $collection->name = $request->name;
        $collection->slug = Str::slug($request->name);
        $collection->save();

        return redirect()->route('collections.index')->with('success', 'Collection name updated successfully.');
    }

    public function destroy($id)
    {
        $collection = BookmarkCollection::where('user_id', Auth::id())->findOrFail($id);
        $collection->delete();

        return redirect()->route('collections.index')->with('success', 'Collection deleted successfully.');
    }
}
