<?php
namespace Database\Seeders;

use App\Models\QuranChapter;
use App\Models\QuranChapterTranslation;
use App\Services\ApiService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class QuranSeeder extends Seeder
{
    public function __construct(protected ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Prevent duplicate seeding
        if (QuranChapter::exists()) {
            $this->command->info('Quran chapters have already been seeded.');
            return;
        }

        try {
            $response = $this->apiService->get("https://api.alquran.cloud/v1/surah");

            if ($response['status'] !== 200) {
                $this->command->error('Failed to fetch Quran chapters: Invalid status');
                return;
            }

            $data = Arr::get($response, 'result.data', []);
            if (empty($data)) {
                $this->command->error('Failed to fetch Quran chapters: No data in response.');
                return;
            }

            $now          = now();
            $chapters     = [];
            $translations = [];

            foreach ($data as $surah) {
                $chapters[] = [
                    'id'               => $surah['number'],
                    'name'             => str_replace('سُورَةُ ', '', $surah['name']),
                    'no_of_verses'     => $surah['numberOfAyahs'],
                    'revelation_place' => $surah['revelationType'],
                    'is_active'        => true,
                    'created_at'       => $now,
                    'updated_at'       => $now,
                ];

                $translations[] = [
                    'quran_chapter_id' => $surah['number'],
                    'lang'             => 'en',
                    'name'             => $surah['englishName'],
                    'translation'      => $surah['englishNameTranslation'],
                    'created_by'       => 1, // Seeder fallback user ID
                    'is_active'        => true,
                    'created_at'       => $now,
                    'updated_at'       => $now,
                ];
            }

            DB::transaction(function () use ($chapters, $translations) {
                QuranChapter::insert($chapters);
                QuranChapterTranslation::insert($translations);
            });

            $this->command->info('Quran chapters seeded successfully.');
        } catch (\Exception $e) {
            $this->command->error('Failed to fetch Quran chapters: ' . $e->getMessage());
            return;
        }
    }
}
