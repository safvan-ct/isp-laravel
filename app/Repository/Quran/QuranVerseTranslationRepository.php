<?php
namespace App\Repository\Quran;

use App\Models\QuranVerseTranslation;

class QuranVerseTranslationRepository implements QuranVerseTranslationInterface
{
    public function getById($id)
    {
        return QuranVerseTranslation::find($id);
    }

    public function dataTable($chapterId, $lang)
    {
        return QuranVerseTranslation::where('quran_chapter_id', $chapterId)->where('lang', $lang);
    }

    public function update(array $data, QuranVerseTranslation $quranVerseTranslation): QuranVerseTranslation
    {
        $quranVerseTranslation->update($data);
        return $quranVerseTranslation;
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
