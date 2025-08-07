<?php
namespace App\Repository\Topic;

use App\Models\TopicVideo;

interface TopicVideoInterface
{
    public function get(int $id);

    public function dataTable($topicId);

    public function create(array $data);

    public function update(array $data, TopicVideo $topicVideo);
}
