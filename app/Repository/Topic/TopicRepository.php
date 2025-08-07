<?php
namespace App\Repository\Topic;

use App\Models\Topic;
use App\Models\TopicTranslation;
use Illuminate\Support\Str;

class TopicRepository implements TopicInterface
{
    public function dataTable(string $type, $parentId = null)
    {
        return Topic::select('id', 'slug', 'is_active', 'position')
            ->where('type', $type)
            ->when($parentId, fn($q) => $q->where('parent_id', $parentId));
    }

    public function create(array $data, string $type): Topic
    {
        $position = Topic::where('type', $type)->count() + 1;

        $obj = Topic::create([
            'slug'      => Str::slug($data['slug']),
            'type'      => $type,
            'position'  => $position,
            'parent_id' => $data['parent_id'] ?? null,
        ]);

        if (in_array($type, ['menu', 'module', 'question'])) {
            TopicTranslation::create([
                'topic_id' => $obj->id,
                'lang'     => 'en',
                'title'    => ucwords($data['slug']),
            ]);
        }

        return $obj;
    }

    public function toggleActive(Topic $topic): void
    {
        $topic->update(['is_active' => ! $topic->is_active]);
    }

    public function sort(array $data): void
    {
        foreach ($data as $item) {
            Topic::where('id', $item['id'])->update(['position' => $item['position']]);
        }
    }

    public function get(int $id, ?string $type = null): Topic
    {
        return Topic::with('translations')
            ->when($type, fn($q) => $q->where('type', $type))
            ->findOrFail($id);
    }
}
