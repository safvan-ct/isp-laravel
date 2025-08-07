<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TopicQuranVerse extends Pivot
{
    protected $table = 'topic_quran_verse';

    protected $fillable = [
        'topic_id',
        'quran_verse_id',
        'simplified',
        'translation_json',
    ];

    protected $casts = [
        'translation_json' => 'array',
    ];

    // Optional relationships
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function quran()
    {
        return $this->belongsTo(QuranVerse::class, 'quran_verse_id');
    }
}
