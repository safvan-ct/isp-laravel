<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
