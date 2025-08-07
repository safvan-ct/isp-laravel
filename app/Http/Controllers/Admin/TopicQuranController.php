<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Topic\QuranStoreRequest;
use App\Http\Requests\Topic\QuranUpdateRequest;
use App\Models\QuranChapterTranslation;
use App\Models\QuranVerse;
use App\Models\TopicQuranVerse;
use App\Repository\Topic\TopicInterface;
use App\Repository\Topic\TopicQuranInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Yajra\DataTables\Facades\DataTables;

class TopicQuranController extends Controller
{
    public function __construct(
        protected TopicInterface $topicRepository,
        protected TopicQuranInterface $topicQuranRepository
    ) {}

    public static function middleware(): array
    {
        return [
            new Middleware(PermissionMiddleware::using(['view topic-quran']), only: ['index', 'dataTable']),
            new Middleware(PermissionMiddleware::using(['store topic-quran']), only: ['store']),
            new Middleware(PermissionMiddleware::using(['update topic-quran']), only: ['update']),
            new Middleware(PermissionMiddleware::using(['delete topic-quran']), only: ['destroy']),
            new Middleware(PermissionMiddleware::using(['active topic-quran']), only: ['status']),
        ];
    }
    public function index($topicId, $id = null)
    {
        $type  = 'answer';
        $topic = $this->topicRepository->get($topicId, $type);
        $quran = is_null($id) ? null : $this->topicQuranRepository->get($id);

        return view('admin.topic.quran', compact('type', 'topic', 'quran'));
    }

    public function store(QuranStoreRequest $request)
    {
        try {
            $this->topicQuranRepository->create($request->only(['topic_id', 'quran_verse_id', 'simplified', 'translation_json']));
            return redirect()->route('admin.topic-quran.index', [$request->topic_id])
                ->with('success', 'Topic Quran created successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.topic-quran.index', [$request->topic_id])
                ->withInput($request->all())
                ->with('error', $e->getMessage());
        }
    }

    public function update(QuranUpdateRequest $request, TopicQuranVerse $topicQuran)
    {
        try {
            $this->topicQuranRepository->update($request->only(['simplified', 'translation_json']), $topicQuran);
            return redirect()->route('admin.topic-quran.index', [$request->topic_id])
                ->with('success', 'Topic Quran updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.topic-quran.index', [$request->topic_id])
                ->withInput($request->all())
                ->with('error', $e->getMessage());
        }
    }

    public function destroy(TopicQuranVerse $topicQuran)
    {
        $topicQuran->delete();
        return response()->json(['message' => 'Topic Quran deleted successfully']);
    }

    public function dataTable(Request $request)
    {
        return DataTables::of($this->topicQuranRepository->dataTable($request->topic_id))->make(true);
    }

    public function fetchQuranChapters(Request $request)
    {
        $chapterId = $request->q;

        $chapters = QuranChapterTranslation::select(['quran_chapter_id', 'name'])
            ->lang('en')
            ->where('quran_chapter_id', $chapterId)
            ->active()
            ->get();

        return response()->json($chapters);
    }

    public function fetchQuranAyahs(Request $request)
    {
        $chapterId  = $request->get('chapter_id');
        $ayahNumber = $request->get('q', '');

        $chapters = QuranVerse::select(['id', 'number_in_chapter', 'text'])
            ->where('quran_chapter_id', $chapterId)
            ->when($ayahNumber, fn($q) => $q->where('number_in_chapter', $ayahNumber))
            ->active()
            ->get();

        return response()->json($chapters);
    }
}
