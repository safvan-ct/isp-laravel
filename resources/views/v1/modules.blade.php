@extends('layouts.app')

@section('content')
    @php
        $quickSummary = [
            'notes' => [
                'റ. അവ്വൽ മാസം, റ. അവ്വൽ 12, നബിദിന ആഘോഷം (ഖുർആൻ, സഹീഹ് ഹദീസ്, ഖലീഫമാരും സ്വഹാബികളും, മദ്ഹബുകളുടെ ഇമാമുമാർ) എന്നിവയെ നേരിട്ട് <strong>ശ്രേഷ്ഠത ഉള്ളതായി പരാമർശിച്ചിട്ടില്ല.</strong>',
                'ചരിത്രപരമായി <strong>പ്രവാചകൻ (ﷺ) ജനിച്ച മാസം</strong> എന്ന നിലയിലാണ് റ. അവ്വൽ <strong>സമൂഹത്തിൽ പ്രസിദ്ധമായത്.</strong>',
                'നബി ﷺ പറഞ്ഞത്: ഞാൻ ജനിച്ച ദിവസമായിരുന്നു അത് (തിങ്കളാഴ്ച). — <em class="text-muted small">മുസ്ലിം: 2747</em>',
                'നബി ﷺ ജനിച്ച കൃത്യമായ തിയ്യതിയെക്കുറിച്ച് ചരിത്രകാരന്മാര്‍ക്കിടയില്‍ <strong>അഭിപ്രായവ്യത്യാസമുണ്ട് (8, 9, 12 എന്നിവ പറയപ്പെടുന്നു).</strong> <strong>12 പ്രധാന അഭിപ്രായം</strong> ആയി മാറി.',
                '<strong>അബ്ബാസി, ഫാത്തിമി</strong> കാലഘട്ടങ്ങളിൽ <strong>മീലാദ് തുടങ്ങുമ്പോൾ, ജനങ്ങൾക്ക് ഒരൊറ്റ തീയതി വേണമായിരുന്നു. അവർ 12 റ.അ. സ്വീകരിച്ചു</strong> → കാരണം അത് ഏറ്റവും പ്രചരിച്ചിരുന്ന അഭിപ്രായം ആയിരുന്നു.',
                'പിന്നീട് വന്നിട്ടുള്ള <strong>ചില പണ്ഡിതർ മീലാദ് ശരീഅത്ത് വിരുദ്ധമായ (ഹറാം) കാര്യങ്ങളില്ലാതെ</strong>, ഖുർആൻ, സലാത്ത്, ദുആ, നബി ചരിത്രം പഠിക്കൽ, ഭക്ഷണം വിതരണം മുതലായവയ്ക്കായി നടത്തിയാൽ അത് <strong>ബിദ്അത് ഹസന (നല്ല പുതുമ)</strong> ആണെന്ന് അഭിപ്രായപ്പെടുന്നു. ചിലർ ഇത് <strong>ബിദ്അത് (പുതുമ) ആയതിനാൽ ഒഴിവാക്കണം</strong> എന്ന് അഭിപ്രായപ്പെടുന്നു.',
            ],
            'good' =>
                'നബി ദിനം ആഘോഷിക്കാത്തത് ഇസ്‌ലാമിക വിരോധമല്ല. മറിച്ച് പ്രവാചകന്റെയും സഹാബികളുടെയും ശരിയായ മാർഗമാണ്.',
            'bad' =>
                'പുതുതായി കൂട്ടിച്ചേർക്കലുകൾ (പ്രതേക വിരുന്ന്, ഗാനങ്ങൾ, ചടങ്ങുകൾ, മൗലിദ് സദസ്സ്, ലൈറ്റുകൾ, കൂട്ടം ചേർന്ന് ആഘോഷിക്കൽ) ചര്യയല്ല ബിദ്അത് ആണ്. (<em class="small">തിർമിധി: 2676</em>)',
            'true' =>
                'പ്രവാചക ചര്യ (സുന്നത്ത്) തിങ്കളാഴ്ച നോമ്പാണ് (<em class="small">മുസ്ലിം: 2747</em>), ജന്മദിനാഘോഷമല്ല.',
            'trust' => [
                'നിനക്ക് അറിവില്ലാത്ത യാതൊരു കാര്യത്തിന്‍റെയും പിന്നാലെ നീ പോകരുത്‌. — <em class="text-muted small">S. 17:36</em>',
                'പുതുതായി കണ്ടുപിടിച്ച കാര്യങ്ങളെ സൂക്ഷിക്കുക, അവ വഴിതെറ്റിയതാണ്. നിങ്ങളിൽ ആരെങ്കിലും അത് കാണുന്നുവെങ്കിൽ, അവൻ എന്റെ സുന്നത്തും സന്മാർഗ്ഗം പ്രാപിച്ച ഖുലഫയുടെ സുന്നത്തും മുറുകെ പിടിക്കണം. — <em class="text-muted small">തിർമിധി: 2676</em>',
                'ക്രിസ്ത്യാനികൾ മർയമിന്റെ മകനെ പുകഴ്ത്തിയതുപോലെ എന്നെ പുകഴ്ത്തരുത്. — <em class="text-muted small">ബുഖാരി: 3445</em>',
            ],
            'alert' =>
                'ആചാരമാക്കുന്നവര്‍ ശുദ്ധമായ തൗഹീദിലും സുന്നത്തിലുമുള്ള മാര്‍ഗ്ഗങ്ങളില്‍ നില്‍ക്കുക. ചെയ്യാത്തവര്‍ക്കു നേരെ അപവാദമില്ല, ചെയ്യുന്നവര്‍ തെറ്റായ കൂട്ടിച്ചേർക്കലുകൾ ഹറാമായ പ്രവർത്തികൾ ഒഴിവാക്കുക.',
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

                    <p class="mb-3 shadow-sm rounded p-2 d-none">
                        ഇസ്ലാമിലെ പ്രധാനമായ രണ്ടു ആഘോഷങ്ങൾ: റമളാനിന് ശേഷം വരുന്ന ഈദ് അൽ-ഫിത്വർ, ഹജ്ജിനോടനുബന്ധിച്ചുള്ള
                        ഈദ് അൽ-അദ്ഹാ. ഇവ ആരാധന, സന്തോഷം, കുടുംബസംഗമം, ദാനം, അല്ലാഹുവിനെ സ്മരിക്കൽ എന്നിവ നിറഞ്ഞ ദിനങ്ങളാണ്.
                    </p>

                    <div class="mt-auto">
                        <span class="badge border rounded-pill text-muted">7 Q</span>
                        <span class="badge border rounded-pill text-muted">94% followed</span>
                        <span class="badge border rounded-pill text-muted">Updated {{ date('d-m-Y') }}</span>

                        <div class="d-flex gap-2 justify-content-end mt-2">
                            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                                data-bs-target="#quickSummaryModal">Preview</button>
                            <button class="btn btn-sm btn-outline-warning">Follow</button>
                            <a class="btn btn-sm btn-outline-success"
                                href="{{ route('questions.show', ['menu_slug' => 'wudu', 'module_slug' => 'namaz']) }}">
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
                    <h5 class="modal-title" id="quickSummaryModalLabel">നബിദിനം</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <x-app.quick-summary :data="$quickSummary" :class="'rounded-0'" />
            </div>
        </div>
    </div>
@endsection
