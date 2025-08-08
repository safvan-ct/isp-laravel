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

    public function getWithAll($id = null, $hadithNumber = null)
    {
        $obj = HadithChapter::select('id', 'hadith_book_id', 'name', 'chapter_number')
            ->with([
                'translations',
                'verses' => fn($q) => $q
                    ->select('id', 'hadith_chapter_id', 'heading', 'text', 'chapter_number', 'hadith_number', 'heading', 'text', 'volume', 'status')
                    ->with('translations')
                    ->when($hadithNumber, fn($q) => $q->where('hadith_number', $hadithNumber))
                    ->active(),

                'book'   => fn($q)   => $q
                    ->select('id', 'name', 'slug', 'writer', 'writer_death_year', 'hadith_count', 'chapter_count')
                    ->with('translations')
                    ->active(),
            ])
            ->whereHas('verses', fn($q) => $q->active()->when($hadithNumber, fn($q) => $q->where('hadith_number', $hadithNumber)))
            ->active();

        return $id ? $obj->find($id) : $obj->get();
    }
}
