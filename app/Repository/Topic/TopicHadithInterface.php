<?php
namespace App\Repository\Topic;

use App\Models\TopicHadithVerse;

interface TopicHadithInterface
{
    public function get(int $id);

    public function dataTable($topicId);

    public function create(array $data);

    public function update(array $data, TopicHadithVerse $topicHadithVerse);

    public function sort(array $data);
}
