@extends('layouts.web-v2')

@section('content')
    <main class="container">
        <header class="page-hero d-flex align-items-center justify-content-between gap-2 flex-column flex-md-row">
            <div class="text-center text-md-start">
                <h5 class="fw-bold text-primary">Topics</h5>
                <p class="text-muted m-0">Browse topics (wudu, namaz, zakat...) — filter by category, evidence, difficulty
                    and tags.</p>
            </div>

            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-outline-success btn-sm">My follows</button>
                <button class="btn btn-accent btn-sm rounded-5">Suggest topic</button>
            </div>
        </header>

        <x-app.filter>
            <div class="row g-2 p-2 bg-white shadow-sm rounded border">
                <!-- Search -->
                <div class="col-12 col-md-6">
                    <input class="form-control form-control-sm"
                        placeholder="Search subjects, tags, or keywords (e.g. 'wudu', 'seerah')" id="search">
                </div>

                <!-- Subject -->
                <div class="col-12 col-md-2">
                    <select id="tagFilter" class="form-select form-select-sm">
                        <option value="featured">Choose Subject</option>
                        <option value="most_questions">Islam</option>
                        <option value="recent">Belief</option>
                        <option value="answered_pct">Life Of Muslim</option>
                    </select>
                </div>

                <!-- Tags -->
                <div class="col-12 col-md-2">
                    <select id="answeredFilter" class="form-select form-select-sm">
                        <option value="all">All tags</option>
                        <option value="tag1">Tag 1</option>
                        <option value="tag2">Tag 2</option>
                        <option value="tag3">Tag 3</option>
                    </select>
                </div>

                <!-- Sort -->
                <div class="col-12 col-md-2">
                    <select id="sortSelect" class="form-select form-select-sm">
                        <option value="featured">Featured</option>
                        <option value="most_questions">Most questions</option>
                        <option value="recent">Recently updated</option>
                        <option value="answered_pct">Highest followed %</option>
                    </select>
                </div>
            </div>
        </x-app.filter>

        <div class="d-flex justify-content-between mb-2 mt-2">
            <p class="text-muted small m-0">Showing <strong>1</strong> subjects</p>
            <p class="text-muted small m-0">
                Followed <strong>{{ $topic->children->where('is_primary', true)->count() }}</strong>
            </p>
        </div>

        <section class="row g-2">
            <div class="col-12 col-md-4 d-flex">
                <article class="card flex-fill p-3">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <div class="icon-card">🎉</div>
                        <div class="flex-1">
                            <h6 class="text-primary fw-bold mb-1">നബിദിനം (റ. അവ്വൽ 12)</h6>
                            <p class="text-muted small mb-0">നബിദിനം ആഘോഷിക്കേണ്ടതിന്റെ അടിസ്ഥാനവും ശ്രേഷ്ഠതയും</p>
                        </div>
                    </div>

                    <p class="mb-3 shadow-sm rounded p-2 d-none">
                        ഇസ്ലാമിലെ പ്രധാനമായ രണ്ടു ആഘോഷങ്ങൾ: റമളാനിന് ശേഷം വരുന്ന ഈദ് അൽ-ഫിത്വർ, ഹജ്ജിനോടനുബന്ധിച്ചുള്ള
                        ഈദ് അൽ-അദ്ഹാ. ഇവ ആരാധന, സന്തോഷം, കുടുംബസംഗമം, ദാനം, അല്ലാഹുവിനെ സ്മരിക്കൽ എന്നിവ നിറഞ്ഞ ദിനങ്ങളാണ്.
                    </p>

                    <div class="mt-auto">
                        <span class="badge border rounded-pill text-muted">7 Q</span>
                        <span class="badge border rounded-pill text-muted">94% followed</span>
                        <span class="badge border rounded-pill text-muted">Updated {{ date('d-m-Y') }}</span>

                        <div class="d-flex gap-2 justify-content-end mt-2">
                            <button class="btn btn-sm btn-outline-warning">Follow</button>
                            <a class="btn btn-sm btn-outline-secondary"
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
