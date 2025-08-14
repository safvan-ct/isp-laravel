<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\BookmarkCollection;
use App\Models\BookmarkItem;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SyncController extends Controller
{
    public function store(Request $request)
    {
        $user      = Auth::user();
        $likes     = $request->likes ?? [];
        $bookmarks = $request->bookmarks ?? [];
        $typeMap   = [
            'quran'  => "App\Models\QuranVerse",
            'hadith' => "App\Models\HadithVerse",
            'topic'  => "App\Models\Topic",
        ];

        foreach ($likes as $like) {
            $key = $like['type'];
            $id  = (int) $like['id'];
            if (! isset($typeMap[$key]) || ! $id) {
                continue;
            }

            Like::firstOrCreate([
                'user_id'       => $user->id,
                'likeable_id'   => $id,
                'likeable_type' => $typeMap[$key],
            ]);
        }

        $collectionsCache = [];
        $now              = now();

        foreach ($bookmarks as $collection => $items) {
            // Normalize collection name & slug once
            $name = ucwords(trim($collection));
            $slug = Str::slug($collection);

            // Cache collection creation to avoid duplicate queries in same request
            if (! isset($collectionsCache[$slug])) {
                $collectionsCache[$slug] = BookmarkCollection::firstOrCreate(
                    ['user_id' => $user->id, 'slug' => $slug],
                    ['name' => $name]
                );
            }

            $clt = $collectionsCache[$slug];

            // Collect all bookmark items for batch insert
            $insertData = [];

            foreach ($items as $key => $ids) {
                if (! isset($typeMap[$key])) {
                    continue; // skip if type is unknown
                }

                foreach (array_filter($ids) as $id) { // array_filter removes empty/null ids
                    $insertData[] = [
                        'user_id'           => $user->id,
                        'collection_id'     => $clt->id,
                        'bookmarkable_id'   => $id,
                        'bookmarkable_type' => $typeMap[$key],
                        'created_at'        => $now,
                        'updated_at'        => $now,
                    ];
                }
            }

            if (! empty($insertData)) {
                // Use insertOrIgnore to prevent duplicates instead of many firstOrCreate calls
                BookmarkItem::insertOrIgnore($insertData);
            }
        }

        return response()->json(['status' => 'success']);
    }
}
