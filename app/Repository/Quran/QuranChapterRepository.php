<?php
namespace App\Repository\Quran;

use App\Models\QuranChapter;

class QuranChapterRepository implements QuranChapterInterface
{
    public function getById($id)
    {
        return QuranChapter::find($id);
    }

    public function dataTable()
    {
        return QuranChapter::select('id', 'name', 'revelation_place', 'no_of_verses', 'is_active');
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

    public function update(array $data, QuranChapter $quranChapter): QuranChapter
    {
        return QuranChapter::updateOrCreate(['id' => $quranChapter->id], $data);
    }

    public function getAll(bool $withTranslations = false, bool $withVerses = false, $id = null)
    {
        $obj = QuranChapter::select(['id', 'name'])
            ->when($withTranslations, fn($q) =>
                $q->with(['translations' => fn($q) => $q->select(['id', 'quran_chapter_id', 'name', 'translation'])->active()->lang()])
            )
            ->when($withVerses, function ($q) {
                $q->with(['verses' => function ($q) {
                    $q->select(['id', 'quran_chapter_id', 'number_in_chapter', 'text'])
                        ->with(['translations' => fn($q) => $q->select(['id', 'quran_verse_id', 'text'])->active()->lang()]);
                }]);
            })
            ->active();

        if ($id) {
            return $obj->where('id', $id)->first();
        }

        return $obj->get();
    }
}
