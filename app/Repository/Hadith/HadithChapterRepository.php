<?php
namespace App\Repository\Hadith;

use App\Models\HadithChapter;

class HadithChapterRepository implements HadithChapterInterface
{
    public function getById($id)
    {
        return HadithChapter::find($id);
    }

    public function dataTable($bookId)
    {
        return HadithChapter::where('hadith_book_id', $bookId);
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

    public function update(array $data, HadithChapter $hadithChapter)
    {
        $hadithChapter->update($data);
        return $hadithChapter;
    }

    public function getAll($id = null, bool $withTranslations = false, bool $withVerses = false, $withBook = false)
    {
        $obj = HadithChapter::select(['id', 'hadith_book_id', 'chapter_number', 'name'])
            ->when($withTranslations, function ($q) {
                $q->with(['translations' => fn($q) => $q->select(['id', 'hadith_chapter_id', 'name'])->active()->lang()]);
            })
            ->when($withVerses, function ($q) {
                $q->with(['verses' => function ($q) {
                    $q->select(['id', 'hadith_chapter_id', 'hadith_number', 'heading', 'text', 'status'])->active()
                        ->with(['translations' => fn($q) => $q->select(['id', 'hadith_verse_id', 'heading', 'text'])->active()->lang()]);
                }]);
            })
            ->when($withBook, function ($q) {
                $q->with(['book' => fn($q) => $q->select(['id', 'name'])->active()]);
            })
            ->active();

        if ($id) {
            return $obj->where('id', $id)->first();
        }

        return $obj->get();
    }
}
