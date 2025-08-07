<?php
namespace App\Models;

use App\Observers\TopicObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([TopicObserver::class])]

class Topic extends Model
{
    protected $fillable = ['parent_id', 'slug', 'type', 'position', 'is_primary', 'is_active'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function parent()
    {
        return $this->belongsTo(Topic::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Topic::class, 'parent_id')->orderBy('position');
    }

    public function getTranslationAttribute()
    {
        return $this->translations->first();
    }

    public function translations()
    {
        return $this->hasMany(TopicTranslation::class);
    }

    public function translation($lang = 'en')
    {
        return $this->hasOne(TopicTranslation::class)->where('lang', $lang);
    }

    public function videos()
    {
        return $this->hasMany(TopicVideo::class);
    }

    public function hadiths()
    {
        return $this->belongsToMany(HadithVerse::class, 'topic_hadith');
    }

    public function quranVerses()
    {
        return $this->hasMany(TopicQuranVerse::class);
    }

    public function hadithVerses()
    {
        return $this->hasMany(TopicHadithVerse::class);
    }
}
