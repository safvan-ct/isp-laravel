<?php
namespace App\Repository\Quran;

use App\Models\QuranChapterTranslation;

class QuranChapterTranslationRepository implements QuranChapterTranslationInterface
{
    public function getById($id)
    {
        return QuranChapterTranslation::find($id);
    }

    public function dataTable($chapterId)
    {
        return QuranChapterTranslation::where('quran_chapter_id', $chapterId);
    }

    public function updateOrCreate(array $data, ?QuranChapterTranslation $quranChapterTranslation = null): QuranChapterTranslation
    {
        return QuranChapterTranslation::updateOrCreate(['id' => $quranChapterTranslation?->id], $data);
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

    public function getChapters(?int $chapterId, string $lang = 'en')
    {
        return QuranChapterTranslation::select(['quran_chapter_id', 'name'])
            ->lang($lang)
            ->when($chapterId, fn($q) => $q->where('quran_chapter_id', $chapterId))
            ->active()
            ->get();
    }
}
