<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class SyncController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        $typeMap = [
            'quran'  => "App\Models\QuranVerse",
            'hadith' => "App\Models\HadithVerse",
            'topic'  => "App\Models\Topic",
        ];

        foreach ($request->likes ?? [] as $like) {
            $key = $like['type'];
            $id  = (int) $like['id'];
            if (! isset($typeMap[$key]) || ! $id) {
                continue;
            }

            Like::firstOrCreate([
                'user_id'       => $user->id,
                'likeable_id'   => $like['id'],
                'likeable_type' => $typeMap[$key],
            ]);
        }

        return response()->json(['status' => 'success']);
    }
}
