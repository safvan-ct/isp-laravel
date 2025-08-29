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
                "റ. അവ്വൽ മാസത്തിന്റെ ശ്രേഷ്ഠത" => [
                    "ഖുർആനിക അടിസ്ഥാനം",
                    "ഹദീസ് അടിസ്ഥാനം",
                    "സഹാബികളും ഖലീഫകളും മുകേനെ ഉള്ള അടിസ്ഥാനം",
                    "ഇ. ഷാഫി മദ്ഹബ് മുഖേന ഉള്ള (അടിസ്ഥാനം, റഫറൻസ്)",
                ],
            ],
            1 => [
                "റ. അവ്വൽ 12 ന്റെ അടിസ്ഥാനം and ശ്രേഷ്ഠത നൽകൽ " => [
                    "ഖുർആനിക അടിസ്ഥാനം",
                    "ഹദീസ് അടിസ്ഥാനം",
                    "സഹാബികളും ഖലീഫകളും മുകേനെ ഉള്ള അടിസ്ഥാനം",
                    "ഇ. ഷാഫി മദ്ഹബ് മുഖേന ഉള്ള (അടിസ്ഥാനം, റഫറൻസ്)",
                ],
            ],
            2 => [
                "മൗലിദ് ആഘോഷം അടിസ്ഥാനം" => [
                    "ഖുർആനിക അടിസ്ഥാനം",
                    "ഹദീസ് അടിസ്ഥാനം",
                    "സഹാബികളും ഖലീഫകളും മുകേനെ ഉള്ള അടിസ്ഥാനം",
                    "ഇ. ഷാഫി മദ്ഹബ് മുഖേന ഉള്ള (അടിസ്ഥാനം, റഫറൻസ്)",
                ],
            ],
            3 => [
                "പ്രവാചകന്റെ ജന്മദിനം ആഘോഷിക്കുന്നത് പ്രവാചക ചര്യ ആണോ?" => [
                    "ഖുർആനിക അടിസ്ഥാനം",
                    "ഹദീസ് അടിസ്ഥാനം",
                    "സഹാബികളും ഖലീഫകളും മുകേനെ ഉള്ള അടിസ്ഥാനം",
                    "ഇ. ഷാഫി മദ്ഹബ് മുഖേന ഉള്ള (അടിസ്ഥാനം, റഫറൻസ്)",
                ],
            ],
            4 => [
                "പ്രവാചകന്റെ ജന്മദിനം ആഘോഷിക്കാത്തത് ഇസ്‌ലാമിക വിരോധമാണോ?" => [],
            ],
            5 => [
                "മീലാദ് ദിനത്തിൽ ഉപവാസം നോക്കണോ?" => [
                    "ഖുർആനിക അടിസ്ഥാനം",
                    "ഹദീസ് അടിസ്ഥാനം",
                    "സഹാബികളും ഖലീഫകളും മുകേനെ ഉള്ള അടിസ്ഥാനം",
                    "ഇ. ഷാഫി മദ്ഹബ് മുഖേന ഉള്ള (അടിസ്ഥാനം, റഫറൻസ്)",
                ],
            ],
            6 => [
                "പ്രവാചകനെ സ്മരിക്കുന്നതിനുള്ള ശരിയായ മാർഗങ്ങൾ എന്തൊക്കെയാണ്?" => [
                    "ഖുർആനിക അടിസ്ഥാനം",
                    "ഹദീസ് അടിസ്ഥാനം",
                    "സഹാബികളും ഖലീഫകളും മുകേനെ ഉള്ള അടിസ്ഥാനം",
                    "ഇ. ഷാഫി മദ്ഹബ് മുഖേന ഉള്ള (അടിസ്ഥാനം, റഫറൻസ്)",
                ],
            ],
            6 => [
                "മൗലിദ് ആഘോഷം സാംസ്കാരിക ചടങ്ങ് (cultural event) മാത്രമാണോ?" => [
                    "ഖുർആനിക അടിസ്ഥാനം",
                    "ഹദീസ് അടിസ്ഥാനം",
                    "സഹാബികളും ഖലീഫകളും മുകേനെ ഉള്ള അടിസ്ഥാനം",
                    "ഇ. ഷാഫി മദ്ഹബ് മുഖേന ഉള്ള (അടിസ്ഥാനം, റഫറൻസ്)",
                ],
            ],
        ];
    }

    public function modules($menuSlug)
    {
        $topic = $this->topicRepository->getMenuWithAll($menuSlug);
        if (! $topic) {
            abort(404);
        }

        return view("web.{$this->webVersion}.modules", compact("topic", "menuSlug"));
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

        return view("web.{$this->webVersion}.questions", compact("module", "menuSlug", "questions"));
    }

    public function answers($menuSlug, $moduleSlug, $questionSlug)
    {
        $question = $this->topicRepository->getQuestionWithAll($questionSlug);
        $module   = $this->topicRepository->getModuleWithAll($moduleSlug);
        if (! $question) {
            //abort(404);
        }
        $qst = $this->questions[$questionSlug];

        return view("web.{$this->webVersion}.answers", compact("question", "module", "menuSlug", "moduleSlug", "qst"));
    }
}
