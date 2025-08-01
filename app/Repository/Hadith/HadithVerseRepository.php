<?php
namespace App\Repository\Hadith;

use App\Models\HadithVerse;

class HadithVerseRepository implements HadithVerseInterface
{
    public function getById($id)
    {
        return HadithVerse::find($id);
    }

    public function dataTable($bookId, $chapterId = null)
    {
        return HadithVerse::where('hadith_book_id', $bookId)
            ->when($chapterId, function ($q) use ($chapterId) {
                return $q->where('hadith_chapter_id', $chapterId);
            });
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

    public function update(array $data, HadithVerse $hadithVerse)
    {
        $hadithVerse->update($data);
        return $hadithVerse;
    }
}
