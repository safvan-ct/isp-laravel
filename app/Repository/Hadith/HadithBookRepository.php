<?php
namespace App\Repository\Hadith;

use App\Models\HadithBook;

class HadithBookRepository implements HadithBookInterface
{
    public function getById($id)
    {
        return HadithBook::find($id);
    }

    public function dataTable()
    {
        return HadithBook::select('id', 'name', 'slug', 'writer', 'writer_death_year', 'chapter_count', 'hadith_count', 'is_active');
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

    public function update(array $data, HadithBook $hadithBook)
    {
        return HadithBook::updateOrCreate(['id' => $hadithBook->id], $data);
    }

    public function getAll(bool $withTranslations = false, bool $withChapters = false, $id = null)
    {
        $obj = HadithBook::select(['id', 'name', 'writer', 'writer_death_year', 'hadith_count', 'chapter_count'])
            ->when($withTranslations, function ($q) {
                $q->with(['translations' => fn($q) => $q->select(['id', 'hadith_book_id', 'name', 'writer', 'description'])->active()->lang()]);
            })
            ->when($withChapters, function ($q) {
                $q->with([
                    'chapters' => fn($q) => $q->select(['id', 'hadith_book_id', 'chapter_number', 'name'])->active()
                        ->with(['translations' => fn($q) => $q->active()->lang()]),
                ]);
            })
            ->active();

        if ($id) {
            return $obj->where('id', $id)->first();
        }

        return $obj->get();
    }
}
