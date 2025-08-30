@extends('layouts.web-v2')

@section('content')
    <main class="container">
        <header class="page-hero-1 d-flex align-items-center justify-content-between gap-2 flex-column flex-md-row">
            <div>
                <h5 class="text-title">Topics</h5>
                <p class="text-muted m-0">
                    Browse topics (wudu, namaz, zakat...) — filter by category, evidence, difficulty and tags.
                </p>
            </div>

            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-outline-success btn-sm">My follows</button>
                <button class="btn btn-accent btn-sm rounded-5">Suggest topic</button>
            </div>
        </header>

        <x-app.filter>
            <div
                class="d-flex flex-wrap align-items-center justify-content-between gap-2 p-2 bg-white shadow-sm rounded-3 border">
                <div class=" w-50 w-sm-100">
                    <input class="form-control" placeholder="Search subjects, tags, or keywords (e.g. 'wudu', 'seerah')">
                </div>

                <div class="control-sm">
                    <select class="form-select form-select-sm">
                        <option value="featured">Choose Subject</option>
                        <option value="most_questions">Islam</option>
                        <option value="recent">Belief</option>
                        <option value="answered_pct">Life Of Muslim</option>
                    </select>
                </div>

                <div class="control-sm">
                    <label class="visually-hidden" for="tagFilter">Tag</label>
                    <select id="tagFilter" class="form-select form-select-sm">
                        <option value="all">All tags</option>
                        <option value="tag1">Tag 1</option>
                        <option value="tag2">Tag 2</option>
                        <option value="tag3">Tag 3</option>
                    </select>
                </div>

                <div class="control-sm">
                    <label class="visually-hidden" for="sortSelect">Sort</label>
                    <select id="sortSelect" class="form-select form-select-sm">
                        <option value="featured">Featured</option>
                        <option value="most_questions">Most questions</option>
                        <option value="recent">Recently updated</option>
                        <option value="answered_pct">Highest followed %</option>
                    </select>
                </div>
            </div>
        </x-app.filter>

        <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
            <p class="text-muted m-0">
                Showing <strong>1</strong> subjects
            </p>
            <p class="text-muted m-0">
                Followed <strong>{{ $topic->children->where('is_primary', true)->count() }}</strong>
            </p>
        </div>

        <section class="row g-2">
            <div class="col-12 col-md-4 d-flex">
                <article class="card">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <div class="icon-bg">🎉</div>

                        <div style="flex:1">
                            <h5 class="card-title">നബിദിനം (റ. അവ്വൽ 12)</h5>
                            <div class="card-desc">നബിദിനം ആഘോഷിക്കേണ്ടതിന്റെ അടിസ്ഥാനവും ശ്രേഷ്ഠതയും</div>
                        </div>
                    </div>

                    <div class="card-body mb-2 d-none">
                        ഇസ്ലാമിലെ പ്രധാനമായ രണ്ടു ആഘോഷങ്ങൾ: റമളാനിന് ശേഷം വരുന്ന ഈദ് അൽ-ഫിത്വർ, ഹജ്ജിനോടനുബന്ധിച്ചുള്ള ഈദ്
                        അൽ-അദ്ഹാ. ഇവ ആരാധന, സന്തോഷം, കുടുംബസംഗമം, ദാനം, അല്ലാഹുവിനെ സ്മരിക്കൽ എന്നിവ നിറഞ്ഞ ദിനങ്ങളാണ്.
                    </div>

                    <div class="card-ft mt-auto">
                        <div class="tag text-muted">7 Q</div>
                        <div class="tag text-muted">94% followed</div>
                        <div class="tag text-muted">Updated {{ date('d-m-Y') }}</div>

                        <div class="d-flex ms-auto gap-2">
                            <button class="btn btn-sm btn-outline-warning">Follow</button>
                            <a class="btn btn-sm btn-outline-secondary" role="button"
                                href="{{ route('questions.show', ['menu_slug' => 'wudu', 'module_slug' => 'namaz']) }}">
                                Preview
                            </a>
                        </div>
                    </div>
                </article>
            </div>

        </section>
    </main>
@endsection
