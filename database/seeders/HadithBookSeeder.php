<?php
namespace Database\Seeders;

use App\Models\HadithBook;
use App\Models\HadithBookTranslation;
use App\Services\ApiService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class HadithBookSeeder extends Seeder
{
    public function __construct(protected ApiService $apiService)
    {}

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (HadithBook::exists()) {
            $this->command->warn('Hadith books already exist.');
            return;
        }

        try {
            $apiKey = config('services.hadith.api_key');
            $url    = str_replace('{api_key}', $apiKey, config('services.hadith.books'));

            $response = $this->apiService->get($url);

            if (Arr::get($response, 'status') !== 200) {
                throw new \Exception('Invalid response status');
            }

            $booksData = Arr::get($response, 'result.books', []);

            if (empty($booksData)) {
                throw new \Exception('No books found in API response');
            }

            $now          = now();
            $books        = [];
            $translations = [];

            foreach ($booksData as $book) {
                if (empty($book['hadiths_count'])) {
                    continue; // Skip books with 0 hadiths
                }

                $bookId      = $book['id'];
                $writerDeath = preg_replace('/\D/', '', $book['writerDeath'] ?? '');

                $books[] = [
                    'id'                => $bookId,
                    'name'              => $book['bookName'],
                    'slug'              => $book['bookSlug'],
                    'writer'            => $book['writerName'] ?? null,
                    'writer_death_year' => is_numeric($writerDeath) ? (int) $writerDeath : null,
                    'chapter_count'     => (int) ($book['chapters_count'] ?? 0),
                    'hadith_count'      => (int) $book['hadiths_count'],
                    'created_at'        => $now,
                    'updated_at'        => $now,
                ];

                $translations[] = [
                    'hadith_book_id' => $bookId,
                    'lang'           => 'en',
                    'name'           => $book['bookName'],
                    'writer'         => $book['writerName'] ?? null,
                    'created_by'     => 1,
                    'created_at'     => $now,
                    'updated_at'     => $now,
                ];
            }

            DB::transaction(function () use ($books, $translations) {
                HadithBook::insert($books);
                HadithBookTranslation::insert($translations);
            });

            $this->command->info('Hadith books seeded successfully.');
        } catch (\Throwable $e) {
            $this->command->error('Failed to seed Hadith books: ' . $e->getMessage());
        }
    }
}
