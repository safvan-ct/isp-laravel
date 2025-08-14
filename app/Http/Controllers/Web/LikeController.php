<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\BookmarkCollection;
use App\Models\BookmarkItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:quran,hadith,topic',
            'id'   => 'required|integer',
        ]);

        $typeMap = [
            'quran'  => "App\Models\QuranVerse",
            'hadith' => "App\Models\HadithVerse",
            'topic'  => "App\Models\Topic",
        ];

        $user = Auth::user();
        if (! $user) {
            return response()->json(['error' => 'Not logged in'], 401);
        }

        $exists = $user->likes()
            ->where('likeable_type', $typeMap[$request->type])
            ->where('likeable_id', $request->id)
            ->exists();

        if ($exists) {
            $user->likes()
                ->where('likeable_type', $typeMap[$request->type])
                ->where('likeable_id', $request->id)
                ->delete();

            return response()->json(['status' => 'removed']);
        } else {
            $user->likes()->create([
                'likeable_id'   => $request->id,
                'likeable_type' => $typeMap[$request->type],
            ]);

            return response()->json(['status' => 'added']);
        }
    }

    public function bookmark(Request $request)
    {
        $request->validate([
            'BookmarkType' => 'required|string|in:quran,hadith,topic',
            'BookmarkItem' => 'required|integer',
            'CollectionId' => 'required|exists:bookmark_collections,id',
        ]);

        $typeMap = [
            'quran'  => "App\Models\QuranVerse",
            'hadith' => "App\Models\HadithVerse",
            'topic'  => "App\Models\Topic",
        ];

        $userId       = Auth::id();
        $type         = $typeMap[$request->BookmarkType];
        $itemId       = $request->BookmarkItem;
        $collectionId = $request->CollectionId;

        $exists = BookmarkItem::where([
            'bookmarkable_id'        => $itemId,
            'bookmarkable_type'      => $type,
            'bookmark_collection_id' => $collectionId,
            'user_id'                => $userId,
        ])->first();

        if ($exists) {
            $exists->delete();

            $found = BookmarkItem::where([
                'bookmarkable_id'   => $itemId,
                'bookmarkable_type' => $type,
                'user_id'           => $userId,
            ])->exists();

            return response()->json(['status' => 'removed', 'found' => $found]);
        }

        $new = BookmarkItem::create([
            'bookmarkable_id'        => $itemId,
            'bookmarkable_type'      => $type,
            'bookmark_collection_id' => $collectionId,
            'user_id'                => $userId,
        ]);

        return response()->json(['status' => 'added', 'collectionItem' => $new, 'found' => true]);
    }

    public function collection(Request $request)
    {
        $request->validate([
            'BookmarkType' => 'required|string|in:quran,hadith,topic',
            'BookmarkItem' => 'required|integer',
            'name'         => 'required|string',
        ]);

        $typeMap = [
            'quran'  => "App\Models\QuranVerse",
            'hadith' => "App\Models\HadithVerse",
            'topic'  => "App\Models\Topic",
        ];

        $userId = Auth::id();
        $slug   = Str::slug($request->name);

        try {
            // Find or create collection
            $collection = BookmarkCollection::firstOrCreate(
                ['slug' => $slug, 'user_id' => $userId],
                ['name' => $request->name]
            );

            $newCollection = $collection->wasRecentlyCreated;

            // Check if bookmark already exists
            $exists = BookmarkItem::where([
                'bookmarkable_id'        => $request->BookmarkItem,
                'bookmarkable_type'      => $typeMap[$request->BookmarkType],
                'bookmark_collection_id' => $collection->id,
                'user_id'                => $userId,
            ])->exists();

            // Create bookmark if it doesn't exist
            if (! $exists) {
                BookmarkItem::create([
                    'bookmarkable_id'        => $request->BookmarkItem,
                    'bookmarkable_type'      => $typeMap[$request->BookmarkType],
                    'bookmark_collection_id' => $collection->id,
                    'user_id'                => $userId,
                ]);
            }

            // Load updated collection with items
            $result = BookmarkCollection::select('id', 'name')
                ->with('items:id,bookmark_collection_id,bookmarkable_id,bookmarkable_type')
                ->where('user_id', $userId)
                ->find($collection->id);

            return response()->json(['status' => 'added', 'collection' => $result, 'newCollection' => $newCollection]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
