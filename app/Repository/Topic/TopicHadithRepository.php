<?php
namespace App\Repository\Topic;

use App\Models\TopicHadithVerse;

class TopicHadithRepository implements TopicHadithInterface
{
    public function get(int $id): TopicHadithVerse
    {
        return $id == 0 ? new TopicHadithVerse() : TopicHadithVerse::findOrFail($id);
    }

    public function dataTable($topicId)
    {
        return TopicHadithVerse::with('hadith.chapter.book')->where('topic_id', $topicId);
    }

    public function create(array $data): TopicHadithVerse
    {
        return TopicHadithVerse::create($data);
    }

    public function update(array $data, TopicHadithVerse $topicHadithVerse): void
    {
        $topicHadithVerse->update($data);
    }
}
