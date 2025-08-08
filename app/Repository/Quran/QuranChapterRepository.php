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

    public function getAll()
    {
        return QuranChapter::select('id', 'name')
            ->active()
            ->get();
    }

    public function getWithTranslations()
    {
        return QuranChapter::select('id', 'name')
            ->with('translations')
            ->active()
            ->get();
    }

    public function getWithVerses($id = null)
    {
        $obj = QuranChapter::select('id', 'name', 'no_of_verses')
            ->with([
                'translations',
                'verses' => fn($q) => $q
                    ->select('id', 'quran_chapter_id', 'number_in_chapter', 'text')
                    ->with('translations')
                    ->active(),
            ])
            ->whereHas('verses', fn($q) => $q->active())
            ->active();

        return $id ? $obj->find($id) : $obj->get();
    }
}
