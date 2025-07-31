<?php
namespace App\Repository\Quran;

use App\Models\QuranVerse;
use App\Services\ApiService;

class QuranVerseRepository implements QuranVerseInterface
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function getById($id)
    {
        return QuranVerse::find($id);
    }

    public function dataTable($chapterId)
    {
        return QuranVerse::where('quran_chapter_id', $chapterId);
    }

    public function status($id)
    {
        $obj = $this->getById($id);
        if (! $obj) {
            throw new \Exception('Item not found');
        }

        $obj->update(['is_active' => ! $obj->is_active]);
        return $obj;
    }

    public function update(array $data, QuranVerse $quranVerse)
    {
        $quranVerse->update($data);
        return $quranVerse;
    }
}
