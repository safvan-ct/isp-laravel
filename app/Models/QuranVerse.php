<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class QuranVerse extends Model
{
    use LogsActivity;

    protected $fillable = ['quran_chapter_id', 'number_in_chapter', 'text', 'juz', 'manzil', 'ruku', 'hizb_quarter', 'sajda', 'is_active'];

    protected static $recordEvents = ['updated'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['text', 'is_active'])
            ->useLogName('quran_verses')
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function getTranslationAttribute()
    {
        return $this->translations->first();
    }

    public function translations()
    {
        return $this->hasMany(QuranVerseTranslation::class);
    }

    public function chapter()
    {
        return $this->belongsTo(QuranChapter::class, 'quran_chapter_id');
    }
}
