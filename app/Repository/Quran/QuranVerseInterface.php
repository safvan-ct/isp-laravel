<?php
namespace App\Repository\Quran;

use App\Models\QuranVerse;

interface QuranVerseInterface
{
    public function getById($id);

    public function dataTable($chapterId);

    public function status($id);

    public function update(array $data, QuranVerse $quranVerse);
}
