@extends('layouts.app')

@section('content')
    @php
        $quickSummary = [
            'notes' => [
                '<strong>നബി ﷺ</strong> തന്റെ ജന്മദിനം <strong>ആഘോഷിച്ചിട്ടില്ല</strong>.',
                '<strong>സഹാബികളും ഖലീഫാക്കളും</strong> (അബൂബക്കർ, ഉമർ, ഉസ്മാൻ, അലി) <strong>ആഘോഷിച്ചിട്ടില്ല</strong>.',
                '<strong>ഖുർആൻ</strong>–ൽ അതിനൊരു നിർദ്ദേശമില്ല.',
                '<strong>ഹദീസ്</strong>: നബി ﷺ തിങ്കളാഴ്ച നോമ്പ് നോൽക്കാറുണ്ടായിരുന്നു - <em class="text-muted small"> മുസ്ലിം: 2747.</em>',
                '<strong>മദ്ഹബുകളുടെ ഇമാമുമാർ</strong>: അവരുടെ കാലത്ത് ആഘോഷങ്ങൾ സ്ഥിരമായിട്ടില്ല.',

                '<strong>അബ്ബാസി, ഫാത്തിമി </strong> കാലഘട്ടങ്ങളിൽ (~500H) <strong>മീലാദ് തുടങ്ങുമ്പോൾ റ.അവ്വൽ 12 സ്വീകരിച്ചു.</strong>',

                '<strong>ചില പണ്ഡിതന്മാർ ഹറാം കാര്യങ്ങളില്ലാതെ</strong>, നടത്തിയാൽ അത് <strong>ബിദ്അത് ഹസന (നല്ല പുതുമ)</strong> ആണെന്ന് അഭിപ്രായപ്പെടുന്നു.',

                '<strong>ചില പണ്ഡിതന്മാർ ഇത് ബിദ്അത് (പുതുമ) ആയതിനാൽ ഒഴിവാക്കണം</strong> എന്ന് അഭിപ്രായപ്പെടുന്നു.',
            ],

            'true' =>
                'പ്രവാചക ചര്യ (സുന്നത്ത്) തിങ്കളാഴ്ച നോമ്പാണ് (<em class="small">മുസ്ലിം: 2747</em>), ജന്മദിനാഘോഷമല്ല.',

            'good' => '<b>നബി ദിനം ആഘോഷിക്കാത്തത് ഇസ്‌ലാമിക വിരോധമല്ല.</b>
                <br><span class="fst-italic small text-muted">എന്റെ സുന്നത്തും സന്മാർഗ്ഗം പ്രാപിച്ച ഖുലഫയുടെ സുന്നത്തും മുറുകെ പിടിക്കണം. — <em class="small">തിർമിധി: 2676</em><span>',

            'bad' => 'പുതുതായി കൂട്ടിച്ചേർക്കലുകൾ <span class="fst-italic small text-muted">(പ്രതേക വിരുന്ന്, ഗാനങ്ങൾ, ചടങ്ങുകൾ, മൗലിദ് സദസ്സ്,
                 ലൈറ്റുകൾ, കൂട്ടം ചേർന്ന് ആഘോഷിക്കൽ)</span> ചര്യയല്ല ബിദ്അത് ആണ്.
                 <p class="fst-italic m-0 mt-2 text-muted small">പുതുതായി കണ്ടുപിടിച്ച കാര്യങ്ങളെ സൂക്ഷിക്കുക, അവ വഴിതെറ്റിയതാണ്.
                        — <em class="small">തിർമിധി: 2676</em></p>
                    <p class="fst-italic m-0 text-muted small">ക്രിസ്ത്യാനികൾ മർയമിന്റെ മകനെ പുകഴ്ത്തിയതുപോലെ എന്നെ നിങ്ങൾ പുകഴ്ത്തരുത്.
                        — <em class="small">ബുഖാരി: 3445</em></p>',

            'alert' => 'ആചാരമാക്കുന്നവര്‍ ശുദ്ധമായ തൗഹീദിലും സുന്നത്തിലുമുള്ള മാര്‍ഗ്ഗങ്ങളില്‍ നില്‍ക്കുക. തെറ്റായ കൂട്ടിച്ചേർക്കലുകൾ ഹറാമായ പ്രവർത്തികൾ ഒഴിവാക്കുക.
                <br><b>നിനക്ക് അറിവില്ലാത്ത യാതൊരു കാര്യത്തിന്‍റെയും പിന്നാലെ നീ പോകരുത്‌. — <em class="small">S. 17:36</em><b>',
        ];
    @endphp

    <main class="container">
        <header class="page-hero d-flex align-items-center justify-content-between gap-2 flex-column flex-md-row">
            <div class="text-center text-md-start">
                <h5 class="fw-bold text-primary text-Playfair text-tr">{{ __('app.topics') }}</h5>
                <p class="text-muted m-0">Browse topics (wudu, namaz, zakat...) — filter by category, evidence, difficulty
                    and tags.</p>
            </div>

            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-outline-success btn-sm">My follows</button>
                <button class="btn btn-accent btn-sm rounded-5">Suggest topic</button>
            </div>
        </header>

        <x-app.filter>
            <div class="row g-2 pb-2 bg-white shadow-sm rounded border">
                <div class="col-12 col-md-6">
                    <input class="form-control form-control-sm"
                        placeholder="Search subjects, tags, or keywords (e.g. 'wudu', 'seerah')" id="search">
                </div>

                <div class="col-12 col-md-2">
                    <select id="tagFilter" class="form-select form-select-sm">
                        <option value="featured">Choose Subject</option>
                        <option value="most_questions">Islam</option>
                        <option value="recent">Belief</option>
                        <option value="answered_pct">Life Of Muslim</option>
                    </select>
                </div>

                <div class="col-12 col-md-2">
                    <select id="answeredFilter" class="form-select form-select-sm">
                        <option value="all">All tags</option>
                        <option value="tag1">Tag 1</option>
                        <option value="tag2">Tag 2</option>
                        <option value="tag3">Tag 3</option>
                    </select>
                </div>

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

                    <div class="mt-auto">
                        <span class="badge border rounded-pill text-muted">3 Q</span>
                        <span class="badge border rounded-pill text-muted">92% followed</span>
                        <span class="badge border rounded-pill text-muted">Updated {{ date('d-m-Y') }}</span>

                        <div class="d-flex gap-2 justify-content-end mt-2">
                            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                                data-bs-target="#quickSummaryModal">Preview</button>
                            <button class="btn btn-sm btn-outline-warning">Follow</button>
                            <a class="btn btn-sm btn-outline-success"
                                href="{{ route('questions.show', ['menu_slug' => 'festival', 'module_slug' => 'meelad']) }}">
                                Open
                            </a>
                        </div>
                    </div>
                </article>
            </div>

            <div class="col-12 col-md-4 d-flex">
                <article class="card flex-fill p-3">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <div class="icon-card">🎉</div>
                        <div class="flex-1">
                            <h6 class="text-primary fw-bold mb-1">മൗലിദ് - പ്രധാന കൃതികൾ</h6>
                            <p class="text-muted small mb-0">മൗലിദ് പാരമ്പര്യം - ചരിത്രവും പ്രധാന കൃതികളും</p>
                        </div>
                    </div>

                    <div class="mt-auto">
                        <span class="badge border rounded-pill text-muted">3 Q</span>
                        <span class="badge border rounded-pill text-muted">95% followed</span>
                        <span class="badge border rounded-pill text-muted">Updated {{ date('d-m-Y') }}</span>

                        <div class="d-flex gap-2 justify-content-end mt-2">
                            {{-- <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                                data-bs-target="#quickSummaryModal">Preview</button> --}}
                            <button class="btn btn-sm btn-outline-warning">Follow</button>
                            <a class="btn btn-sm btn-outline-success"
                                href="{{ route('questions.show', ['menu_slug' => 'festival', 'module_slug' => 'moulid']) }}">
                                Open
                            </a>
                        </div>
                    </div>
                </article>
            </div>
        </section>
    </main>

    <div class="modal fade" id="quickSummaryModal" tabindex="-1" aria-labelledby="quickSummaryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header position-sticky top-0 z-3 bg-white">
                    <h6 class="modal-title text-primary m-0" id="quickSummaryModalLabel">നബിദിനം</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <x-app.quick-summary :data="$quickSummary" :class="'p-2'" />
            </div>
        </div>
    </div>
@endsection
