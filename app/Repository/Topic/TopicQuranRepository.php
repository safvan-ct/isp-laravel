<?php
namespace App\Repository\Topic;

use App\Models\TopicQuranVerse;

class TopicQuranRepository implements TopicQuranInterface
{
    public function get(int $id): TopicQuranVerse
    {
        return $id == 0 ? new TopicQuranVerse() : TopicQuranVerse::findOrFail($id);
    }

    public function dataTable($topicId)
    {
        return TopicQuranVerse::with('quran')->where('topic_id', $topicId);
    }

    public function create(array $data): TopicQuranVerse
    {
        return TopicQuranVerse::create($data);
    }

    public function update(array $data, TopicQuranVerse $topicQuranVerse): void
    {
        $topicQuranVerse->update($data);
    }
}
