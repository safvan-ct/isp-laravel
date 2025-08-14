<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\BookmarkCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookmarkCollectionController extends Controller
{
    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $collection       = BookmarkCollection::where('user_id', Auth::id())->findOrFail($id);
        $collection->name = $request->name;
        $collection->slug = Str::slug($request->name);
        $collection->save();

        return redirect()->route('bookmarks')->with('success', 'Collection name updated successfully.');
    }

    public function destroy($id)
    {
        $collection = BookmarkCollection::where('user_id', Auth::id())->findOrFail($id);
        $collection->delete();

        return redirect()->route('bookmarks')->with('success', 'Collection deleted successfully.');
    }
}
