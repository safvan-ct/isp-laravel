<?php
namespace App\Repository\Topic;

use App\Models\TopicVideo;

class TopicVideoRepository implements TopicVideoInterface
{
    public function get(int $id): TopicVideo
    {
        return $id == 0 ? new TopicVideo() : TopicVideo::findOrFail($id);
    }

    public function dataTable($topicId)
    {
        return TopicVideo::where('topic_id', $topicId)->orderBy('position');
    }

    public function create(array $data): TopicVideo
    {
        $position         = TopicVideo::count() + 1;
        $data['position'] = $position;
        return TopicVideo::create($data);
    }

    public function update(array $data, TopicVideo $topicVideo): void
    {
        $topicVideo->update($data);
    }

    public function sort(array $data): void
    {
        foreach ($data as $item) {
            TopicVideo::where('id', $item['id'])->update(['position' => $item['position']]);
        }
    }
}
