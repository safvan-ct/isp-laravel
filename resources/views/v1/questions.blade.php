@extends('layouts.app')

@push('styles')
@endpush

@section('content')
    @php
        $quickSummary = [
            'notes' => [
                '<strong>ഖുർആൻ, സഹീഹ് ഹദീസ്, ഖലീഫമാരും സ്വഹാബികളും, മദ്ഹബുകളുടെ ഇമാമുമാർ</strong> റ. അവ്വൽ മാസം, റ. അവ്വൽ 12,
                നബിദിന ആഘോഷം എന്നിവയെ നേരിട്ട് <strong>ശ്രേഷ്ഠത ഉള്ളതായി പരാമർശിച്ചിട്ടില്ല.</strong>',

                'ചരിത്രപരമായി <strong>പ്രവാചകൻ (ﷺ) ജനിച്ച മാസം</strong> എന്ന നിലയിലാണ് റ. അവ്വൽ <strong>സമൂഹത്തിൽ പ്രസിദ്ധമായത്.</strong>',

                'നബി ﷺ പറഞ്ഞത്: ഞാൻ <strong>ജനിച്ച ദിവസമായിരുന്നു അത് (തിങ്കളാഴ്ച).</strong> — <em class="text-muted small">മുസ്ലിം: 2747</em>',

                'നബി ﷺ ജനിച്ച കൃത്യമായ <strong>തിയ്യതിയെക്കുറിച്ച് ചരിത്രകാരന്മാര്‍ക്കിടയില്‍ അഭിപ്രായവ്യത്യാസമുണ്ട്</strong> (8, 9, 12)
                എന്നിവ പറയപ്പെടുന്നു. <strong>12 പ്രധാന അഭിപ്രായം</strong> ആയി മാറി.',

                '<strong>അബ്ബാസി, ഫാത്തിമി</strong> കാലഘട്ടങ്ങളിൽ <strong>മീലാദ് തുടങ്ങുമ്പോൾ,</strong> ഒറ്റ തീയതി വേണമായിരുന്നു.
                <strong>അവർ റ.അവ്വൽ 12 സ്വീകരിച്ചു</strong>',

                '<strong>പിന്നീട് വന്നിട്ടുള്ള കാലഘട്ടങ്ങളിൽ മീലാദ് ആഘോഷമായും, ആചാരമായും പ്രചരിച്ചു.</strong>',

                '<strong>ചില പണ്ഡിതർ മീലാദ് ശരീഅത്ത് വിരുദ്ധമായ (ഹറാം) കാര്യങ്ങളില്ലാതെ</strong>, ഖുർആൻ, സലാത്ത്, ദുആ, നബി ചരിത്രം
                പഠിക്കൽ, ഭക്ഷണം വിതരണം മുതലായവയ്ക്കായി നടത്തിയാൽ അത് <strong>ബിദ്അത് ഹസന (നല്ല പുതുമ)</strong> ആണെന്ന്
                അഭിപ്രായപ്പെടുന്നു. <br><strong>ചില പണ്ഡിതർ ഇത് ബിദ്അത് (പുതുമ) ആയതിനാൽ ഒഴിവാക്കണം</strong> എന്ന് അഭിപ്രായപ്പെടുന്നു.',
            ],
            'true' => 'പ്രവാചക ചര്യ (സുന്നത്ത്) തിങ്കളാഴ്ച നോമ്പാണ് (<em class="small">മുസ്ലിം: 2747</em>).',
            'good' => '<b>നബി ദിനം ആഘോഷിക്കാത്തത് ഇസ്‌ലാമിക വിരോധമല്ല. മറിച്ച് പ്രവാചകന്റെയും സഹാബികളുടെയും ശരിയായ മാർഗമാണ്.</b>
                <br><span class="fst-italic small text-muted">പുതുതായി കണ്ടുപിടിച്ച കാര്യങ്ങളെ സൂക്ഷിക്കുക, കാരണം അവ വഴിതെറ്റിയതാണ്.
                    നിങ്ങളിൽ ആരെങ്കിലും അത് കാണുന്നുവെങ്കിൽ, അവൻ എന്റെ സുന്നത്തും സന്മാർഗ്ഗം പ്രാപിച്ച ഖുലഫയുടെ സുന്നത്തും
                    മുറുകെ പിടിക്കണം, അണപ്പല്ലുകൾ കൊണ്ട് അത് മുറുകെ പിടിക്കണം. — <em class="small">തിർമിധി: 2676</em><span>',
            'bad' => '<b>പുതുതായി കൂട്ടിച്ചേർക്കലുകൾ</b> (പ്രതേക വിരുന്ന്, ഗാനങ്ങൾ, ചടങ്ങുകൾ, മൗലിദ് സദസ്സ്, ലൈറ്റുകൾ, കൂട്ടം ചേർന്ന് ആഘോഷിക്കൽ)
                <b> ചര്യയല്ല ബിദ്അത് ആണ്.</b> (<em class="small">തിർമിധി: 2676</em>)
                    <p class="fst-italic m-0 mt-2 text-muted small">ക്രിസ്ത്യാനികൾ മർയമിന്റെ മകനെ പുകഴ്ത്തിയതുപോലെ എന്നെ നിങ്ങൾ പുകഴ്ത്തരുത്.
                        — <em class="small">ബുഖാരി: 3445</em></p>',
            'alert' => 'ആചാരമാക്കുന്നവര്‍ ശുദ്ധമായ തൗഹീദിലും സുന്നത്തിലുമുള്ള മാര്‍ഗ്ഗങ്ങളില്‍ നില്‍ക്കുക. തെറ്റായ കൂട്ടിച്ചേർക്കലുകൾ ഹറാമായ പ്രവർത്തികൾ ഒഴിവാക്കുക.
                <br><b>നിനക്ക് അറിവില്ലാത്ത യാതൊരു കാര്യത്തിന്‍റെയും പിന്നാലെ നീ പോകരുത്‌. — <em class="small">S. 17:36</em><b>',
        ];
    @endphp

    <main class="container">
        <header class="page-hero">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('app.home') }}</a></li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('modules.show', 'life-of-muslim') }}">{{ __('app.topics') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">നബിദിനം</li>
                </ol>
            </nav>

            <hr class="mt-1 mb-3">

            <div class="text-center">
                <h5 class="fw-bold text-primary text-Playfair text-tr m-0">നബിദിനം - <small>അനുബന്ധ വിഷയങ്ങൾ</small></h5>
                <p class="text-muted m-0">നബിദിനം ആഘോഷിക്കേണ്ടതിന്റെ അടിസ്ഥാനവും ശ്രേഷ്ഠതയും</p>
            </div>
        </header>

        <x-app.filter>
            <div class="row g-2 pb-2 bg-white shadow-sm rounded border align-items-center">
                <div class="col-12 col-md">
                    <input class="form-control form-control-sm" placeholder="Search topics, tags, or content"
                        id="search">
                </div>

                <div class="col-6 col-md-auto">
                    <select id="tagFilter" class="form-select form-select-sm">
                        <option value="all">All Subjects</option>
                    </select>
                </div>

                <div class="col-6 col-md-auto">
                    <select id="answeredFilter" class="form-select form-select-sm">
                        <option value="all">All</option>
                        <option value="answered">Answered</option>
                        <option value="unanswered">Unanswered</option>
                    </select>
                </div>

                <div class="col-6 col-md-auto">
                    <select id="sortSelect" class="form-select form-select-sm">
                        <option value="best">Best (verified + helpful)</option>
                        <option value="newest">Newest</option>
                        <option value="helpful">Most helpful</option>
                    </select>
                </div>

                <div class="col-12 col-md-auto ms-md-auto d-flex gap-2 justify-content-end">
                    <button class="btn btn-warning btn-sm rounded-pill">Ask Query</button>
                    <button class="btn btn-outline-secondary btn-sm">Bookmarks</button>
                </div>
            </div>
        </x-app.filter>

        <section class="mt-3">
            <div class="row g-2">
                @foreach ($questions as $key => $item)
                    @php
                        // safe extraction whether $item is object or plain string
                        $title = is_object($item) ? $item->title ?? ($item->question ?? 'Untitled') : $item;
                        $addedAt = is_object($item) && isset($item->created_at) ? $item->created_at : now();
                        $tags =
                            is_object($item) && isset($item->tags)
                                ? $item->tags
                                : ['festival', 'birthday', 'prophet', 'meelad'];
                        $answersCount = is_object($item) && isset($item->answers_count) ? $item->answers_count : 2;
                    @endphp

                    <div class="col-12 col-md-4">
                        <article class="card h-100 d-flex flex-column p-3">
                            <h6 class="text-primary fw-bold mb-2">{{ $loop->iteration }} : {{ $title }}</h6>

                            <p class="small text-muted mb-2">
                                <span>Added • </span>
                                <time datetime="{{ \Carbon\Carbon::parse($addedAt)->toDateString() }}">
                                    {{ \Carbon\Carbon::parse($addedAt)->format('d-m-Y') }}
                                </time>
                                <span>•</span>
                                <span>{{ $answersCount }} answers</span>
                            </p>

                            <div class="mb-2">
                                @foreach ($tags as $tag)
                                    <span class="badge rounded-pill bg-light text-dark border">{{ $tag }}</span>
                                @endforeach
                            </div>

                            <div class="mt-auto d-flex gap-2 justify-content-end">
                                <a href="{{ route('answers.show', ['menu_slug' => 'festival', 'module_slug' => 'meelad', 'question_slug' => $key]) }}"
                                    class="btn btn-sm btn-outline-success"
                                    aria-label="Open question {{ $loop->iteration }}">
                                    Open
                                </a>

                                <button type="button" class="btn btn-sm btn-outline-secondary"
                                    aria-label="Share question {{ $loop->iteration }}">
                                    Share
                                </button>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </section>
    </main>

    <button type="button"
        class="btn btn-success rounded-circle shadow-lg position-fixed bottom-0 m-4 mb-4 z-3 d-flex align-items-center justify-content-center"
        style="width: 40px; height: 40px;" data-bs-toggle="modal" data-bs-target="#quickSummaryModal" title="Quick Summary">
        <i class="fas fa-list-ul fa-lg"></i>
    </button>

    <button type="button" class="btn btn-secondary rounded-pill position-fixed bottom-0 end-0 me-3 mb-2 z-3"
        data-bs-toggle="modal" data-bs-target="#quranHadithModal">
        <i class="fas fa-book text-white"></i>
    </button>

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
