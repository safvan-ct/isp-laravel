<?php
namespace App\Repository\Hadith;

use App\Models\HadithBookTranslation;

class HadithBookTranslationRepository implements HadithBookTranslationInterface
{
    public function getById($id)
    {
        return HadithBookTranslation::find($id);
    }

    public function dataTable($bookId)
    {
        return HadithBookTranslation::where('hadith_book_id', $bookId)->select(['id', 'lang', 'name', 'writer', 'is_active']);
    }

    public function updateOrCreate(array $data, ?HadithBookTranslation $hadithBookTranslation = null)
    {
        return HadithBookTranslation::updateOrCreate(['id' => $hadithBookTranslation?->id], $data);
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

    public function getBooks(?string $name, string $lang = 'en')
    {
        return HadithBookTranslation::select(['hadith_book_id', 'name'])
            ->when($name, fn($q) => $q->where('name', 'like', '%' . $name . '%'))
            ->lang($lang)
            ->active()
            ->get();
    }
}
