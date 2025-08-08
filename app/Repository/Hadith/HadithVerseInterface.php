<?php
namespace App\Repository\Hadith;

use App\Models\HadithVerse;

interface HadithVerseInterface
{
    public function getById($id);

    public function dataTable($bookId, $chapterId = null);

    public function status($id);

    public function update(array $data, HadithVerse $hadithVerse);

    public function getByWhere($where = []);
}
