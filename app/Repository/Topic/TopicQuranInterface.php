<?php
namespace App\Repository\Topic;

use App\Models\TopicQuranVerse;

interface TopicQuranInterface
{
    public function get(int $id);

    public function dataTable($topicId);

    public function create(array $data);

    public function update(array $data, TopicQuranVerse $topicQuranVerse);
}
