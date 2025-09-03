<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repository\Topic\TopicInterface;

class TopicController extends Controller
{
    protected $webVersion;
    protected $questions;

    public function __construct(protected TopicInterface $topicRepository)
    {
        $this->webVersion = config("constants.web_version");
        $this->questions  = [
            0 => [
                "റ. അവ്വൽ മാസത്തിന്റെ ശ്രേഷ്ഠത, റ.അ. 12 ന്റെ അടിസ്ഥാനം" => [
                    "ഖുർആൻ പരാമർശം",
                    "ഹദീസ് പരാമർശം",
                    "ഖലീഫമാരും  സ്വഹാബികളും മുഖേന ഉള്ള (അടിസ്ഥാനം, റഫറൻസ്)",
                    "മദ്ഹബുകളുടെ ഇമാമുമാർ മുഖേന ഉള്ള (അടിസ്ഥാനം, റഫറൻസ്)",
                ],
            ],
            1 => [
                "നബിദിന ആഘോഷങ്ങളുടെ അടിസ്ഥാനം & പ്രവാചക ചര്യ (സുന്നത്ത്)" => [
                    "ഖുർആൻ പരാമർശം",
                    "ഹദീസ് പരാമർശം",
                    "ഖലീഫമാരും  സ്വഹാബികളും മുഖേന ഉള്ള (അടിസ്ഥാനം, റഫറൻസ്)",
                    "മദ്ഹബുകളുടെ ഇമാമുമാർ മുഖേന ഉള്ള (അടിസ്ഥാനം, റഫറൻസ്)",
                ],
            ],
            2 => [
                "ചരിത്രം" => [],
            ],
        ];
    }

    public function modules($menuSlug)
    {
        $topic = $this->topicRepository->getMenuWithAll($menuSlug);
        if (! $topic) {
            abort(404);
        }

        return view("{$this->webVersion}.modules", compact("topic", "menuSlug"));
    }

    public function questions($menuSlug, $moduleSlug)
    {
        $module = $this->topicRepository->getModuleWithAll($moduleSlug);
        if (! $module) {
            //abort(404);
        }

        $questions = [];
        foreach ($this->questions as $q) {
            $questions[] = array_keys($q)[0];
        }

        return view("{$this->webVersion}.{$moduleSlug}.index", compact("module", "menuSlug", "questions"));
    }

    public function answers($menuSlug, $moduleSlug, $questionSlug)
    {
        $question = $this->topicRepository->getQuestionWithAll($questionSlug);
        $module   = $this->topicRepository->getModuleWithAll($moduleSlug);
        if (! $question) {
            //abort(404);
        }
        $qst       = $this->questions[$questionSlug];
        $questions = [];
        foreach ($this->questions as $q) {
            $questions[] = array_keys($q)[0];
        }
        $page = in_array($questionSlug, [0, 1, 2, 3, 4]) ? $questionSlug + 1 : 'template';

        return view("{$this->webVersion}.meelad.{$page}", compact("question", "module", "menuSlug", "moduleSlug", "qst", "questions"));
    }
}
