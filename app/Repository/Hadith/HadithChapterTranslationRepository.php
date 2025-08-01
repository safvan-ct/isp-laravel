<?php
namespace App\Repository\Hadith;

use App\Models\HadithChapterTranslation;

class HadithChapterTranslationRepository implements HadithChapterTranslationInterface
{
    public function getById($id)
    {
        return HadithChapterTranslation::find($id);
    }

    public function dataTable($chapterId)
    {
        return HadithChapterTranslation::where('hadith_chapter_id', $chapterId);
    }

    public function updateOrCreate(array $data, ?HadithChapterTranslation $hadithChapterTranslation = null): HadithChapterTranslation
    {
        return HadithChapterTranslation::updateOrCreate(['id' => $hadithChapterTranslation?->id], $data);
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
}
