<?php
namespace App\Repository\Hadith;

use App\Models\HadithVerseTranslation;

class HadithVerseTranslationRepository implements HadithVerseTranslationInterface
{
    public function getById($id)
    {
        return HadithVerseTranslation::find($id);
    }

    public function dataTable($verseId)
    {
        return HadithVerseTranslation::where('hadith_verse_id', $verseId);
    }

    public function updateOrCreate(array $data, ?HadithVerseTranslation $hadithVerseTranslation = null): HadithVerseTranslation
    {
        return HadithVerseTranslation::updateOrCreate(['id' => $hadithVerseTranslation?->id], $data);
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
