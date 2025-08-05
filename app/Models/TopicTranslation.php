<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopicTranslation extends Model
{
    protected $fillable = ['topic_id', 'lang', 'title', 'content', 'is_active'];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
