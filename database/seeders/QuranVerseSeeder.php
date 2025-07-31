<?php
namespace Database\Seeders;

use App\Models\QuranVerse;
use App\Models\QuranVerseTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class QuranVerseSeeder extends Seeder
{
    public function run(): void
    {
        if (QuranVerse::exists()) {
            $this->command->info('Quran verses already seeded.');
            return;
        }

        $this->command->info('Fetching Quran verses...');

        try {
            // Fetch Arabic
            $arabic    = Http::get('https://api.alquran.cloud/v1/quran/quran-uthmani')->json('data.surahs');
            $english   = Http::get('https://api.alquran.cloud/v1/quran/en.asad')->json('data.surahs');
            $malayalam = Http::get('https://api.alquran.cloud/v1/quran/ml.abdulhameed')->json('data.surahs');
            $hindi     = Http::get('https://api.alquran.cloud/v1/quran/hi.hindi')->json('data.surahs');

            $verses       = [];
            $translations = [];
            $now          = now();

            foreach ($arabic as $surahIndex => $surah) {
                $ayahs = $surah['ayahs'];
                foreach ($ayahs as $i => $ayah) {
                    $verseId = $ayah['number'];

                    $verses[] = [
                        'id'                => $verseId,
                        'quran_chapter_id'  => $surah['number'],
                        'number_in_chapter' => $ayah['numberInSurah'],
                        'text'              => $ayah['text'],
                        'juz'               => $ayah['juz'],
                        'manzil'            => $ayah['manzil'],
                        'ruku'              => $ayah['ruku'],
                        'hizb_quarter'      => $ayah['hizbQuarter'],
                        'sajda'             => is_array($ayah['sajda']) ? ($ayah['sajda']['obligatory'] ? 2 : 1) : ($ayah['sajda'] ? 1 : 0),
                        'is_active'         => true,
                        'created_at'        => $now,
                        'updated_at'        => $now,
                    ];

                    // English
                    $textEn         = Arr::get($english, "$surahIndex.ayahs.$i.text");
                    $translations[] = [
                        'quran_chapter_id'  => $surah['number'],
                        'quran_verse_id'    => $verseId,
                        'number_in_chapter' => $ayah['numberInSurah'],
                        'lang'              => 'en',
                        'text'              => $textEn,
                        'created_by'        => 1,
                        'is_active'         => true,
                        'created_at'        => $now,
                        'updated_at'        => $now,
                    ];

                    // Malayalam
                    $textMl         = Arr::get($malayalam, "$surahIndex.ayahs.$i.text");
                    $translations[] = [
                        'quran_chapter_id'  => $surah['number'],
                        'quran_verse_id'    => $verseId,
                        'number_in_chapter' => $ayah['numberInSurah'],
                        'lang'              => 'ml',
                        'text'              => $textMl,
                        'created_by'        => 1,
                        'is_active'         => true,
                        'created_at'        => $now,
                        'updated_at'        => $now,
                    ];

                    // Hindi
                    $textHi         = Arr::get($hindi, "$surahIndex.ayahs.$i.text");
                    $translations[] = [
                        'quran_chapter_id'  => $surah['number'],
                        'quran_verse_id'    => $verseId,
                        'number_in_chapter' => $ayah['numberInSurah'],
                        'lang'              => 'hi',
                        'text'              => $textHi,
                        'created_by'        => 1,
                        'is_active'         => true,
                        'created_at'        => $now,
                        'updated_at'        => $now,
                    ];

                    if (count($verses) === 500) {
                        DB::transaction(function () use ($verses, $translations) {
                            collect($verses)->chunk(500)->each(function ($chunk) {
                                QuranVerse::insert($chunk->toArray());
                            });

                            collect($translations)->chunk(500)->each(function ($chunk) {
                                QuranVerseTranslation::insert($chunk->toArray());
                            });
                        });

                        $verses       = [];
                        $translations = [];
                    }
                }
            }

            DB::transaction(function () use ($verses, $translations) {
                collect($verses)->chunk(500)->each(function ($chunk) {
                    QuranVerse::insert($chunk->toArray());
                });

                collect($translations)->chunk(500)->each(function ($chunk) {
                    QuranVerseTranslation::insert($chunk->toArray());
                });
            });
        } catch (\Exception $e) {
            $this->command->error('Failed to fetch Quran verses: ' . $e->getMessage());
            return;
        }

        $this->command->info('Quran verses and translations seeded successfully.');
    }
}
