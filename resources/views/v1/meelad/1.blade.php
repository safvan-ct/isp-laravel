@extends('layouts.app')

@section('content')
    <main class="container">
        <header class="page-hero">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('app.home') }}</a></li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('modules.show', 'life-of-muslim') }}">{{ __('app.topics') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('questions.show', ['menu_slug' => 'wudu', 'module_slug' => 'namaz']) }}">
                            നബിദിനം
                        </a>
                    </li>
                </ol>
            </nav>

            <hr class="mt-1 mb-3">

            <div class="text-center">
                <h5 class="fw-bold text-primary text-Playfair text-tr m-0">{{ array_keys($qst)[0] }}</h5>
                <p class="text-muted m-0">
                    ഖുർആൻ, ഹദീസ്, പ്രാമാണിക തെളിവുകൾ ഉൾക്കൊള്ളുന്ന പ്രായോഗിക ഘട്ടം ഘട്ടമായുള്ള മാർഗനിർദേശം.
                </p>
            </div>

            <div class="d-flex justify-content-between flex-column flex-md-row mt-2 d-none">
                <div>
                    <span class="tag fw-bold">Est. 12 min</span>
                    <span class="tag fw-bold">Difficulty: Easy</span>
                    <span class="tag fw-bold">Progress: 35%</span>
                </div>
                <div class="d-flex gap-2 mt-2 mt-md-0">
                    <button class="btn btn-outline-warning">☆ Bookmark</button>
                    <button class="btn btn-outline-secondary">✎ Note</button>
                </div>
            </div>

            <div class="text-center mx-auto mt-3">
                <div class="ayah-card">
                    <h5 class="text-arabic text-primary mt-2 lh-lg mb-2" dir="rtl">
                        ﴿ وَإِيَّاكُمْ وَمُحْدَثَاتِ الْأُمُورِ فَإِنَّهَا ضَلَالَةٌ، ‏‏‏‏‏‏فَمَنْ أَدْرَكَ ذَلِكَ مِنْكُمْ
                        فَعَلَيْهِ بِسُنَّتِي وَسُنَّةِ الْخُلَفَاءِ الرَّاشِدِينَ الْمَهْدِيِّينَ ﴾
                    </h5>

                    <p class="fst-italic small m-0">
                        പുതുതായി കണ്ടുപിടിച്ച കാര്യങ്ങളെ സൂക്ഷിക്കുക, കാരണം അവ വഴിതെറ്റിയതാണ്. നിങ്ങളിൽ ആരെങ്കിലും അത്
                        കാണുന്നുവെങ്കിൽ, അവൻ എന്റെ സുന്നത്തും സന്മാർഗ്ഗം പ്രാപിച്ച ഖുലഫയുടെ സുന്നത്തും മുറുകെ പിടിക്കണം.
                    </p>

                    <p class="m-0 mt-1 text-muted small">ജാമി അൽ-തിർമിധി: 2676</p>
                </div>
            </div>
        </header>

        <div class="row g-2 my-1">
            <section class="col-lg-8">
                <article class="card-surface">
                    <h5 class="text-primary fw-bold mb-1">{{ array_keys($qst)[0] }}</h5>
                    <h6 class="text-arabic mb-2 d-none">خطوات الوضوء مع توضيح بالأشكال</h6>

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start">
                        <p class="text-muted small mb-0">
                            Author: Author Name • Reviewed • Verified
                        </p>

                        <p class="small text-muted mb-0">
                            Last review:
                            <time datetime="{{ now()->toDateString() }}">{{ now()->format('M d, Y') }}</time>
                            by <strong>Reviewer Name</strong>
                        </p>
                    </div>

                    <div class="mt-2 d-flex flex-wrap gap-2 d-none" aria-label="tags">
                        <span class="badge bg-secondary">Understand intention (niyyah)</span>
                        <span class="badge bg-secondary">Step order and minimal wipes</span>
                        <span class="badge bg-secondary">When tayammum is allowed</span>
                    </div>

                    <hr class="mt-3 mb-3">

                    @foreach (array_values($qst)[0] as $key => $item)
                        <div class="step-card mb-2">
                            <div class="num-card">{{ $key + 1 }}</div>
                            <div class="flex-1">
                                <div class="fw-bold">{{ $item }}</div>
                                @if ($key == 0)
                                    <p class="small text-muted m-0">
                                        റ. അവ്വൽ മാസത്തിന്റെ <strong>പ്രത്യേക ശ്രേഷ്ഠതയെ കുറിച്ച് ഖുർആനിൽ നേരിട്ട്
                                            പരാമർശമില്ല.</strong>
                                    </p>
                                @endif

                                @if ($key == 1)
                                    <p class="small text-muted m-0">
                                        <strong>സഹീഹ് ബുഖാരി, സഹീഹ് മുസ്ലിം</strong> പോലുള്ള വിശ്വസ്ത ഹദീസ് ഗ്രന്ഥങ്ങളിൽ
                                        <strong>റ. അവ്വൽ മാസത്തെ പ്രത്യേകിച്ച് വാഴ്ത്തുന്ന</strong> ഒരു ഹദീസും ഇല്ല.
                                    </p>
                                @endif

                                @if ($key == 2)
                                    <p class="small text-muted m-0">
                                        അബൂബക്കർ(റ), ഉമർ (റ), ഉസ്മാൻ (റ), അലി (റ) എന്നിവർ <strong>പ്രവാചകൻ ﷺ ജനിച്ച ദിവസം
                                            ആഘോഷിക്കുകയോ, റ. അവ്വൽ മാസത്തെ പ്രത്യേകിച്ച് വാഴ്ത്തുകയോ ചെയ്തിട്ടില്ല.</strong>
                                    </p>
                                @endif

                                @if ($key == 3)
                                    <p class="small text-muted m-0">
                                        റ . അവ്വൽ മാസത്തെ കുറിച്ച് <strong>മദ്ഹബുകളുടെ ഇമാമുമാരുടെ (ഇമാം അബൂ ഹനീഫ, ഇമാം
                                            മാലിക്, ഇമാം ശാഫിഈ, ഇമാം ഹൻബലി)</strong> നിലപാട് നോക്കുമ്പോൾ, അവരുടെ കാലത്ത്
                                        <strong>ഈ മാസത്തെ പ്രത്യേകമായി മഹത്വപ്പെടുത്തിയ പ്രവർത്തി ഒന്നും ഇല്ല.</strong>
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <div class="card mb-3 mt-3 shadow-sm">
                        <h5 class="fw-bold text-primary">Quick summary</h5>

                        <p class="mb-2">
                            🔹 റ. അവ്വൽ മാസം <strong>ഖുർആനിലോ, സഹീഹ് ഹദീസ് പ്രകാരമോ, ഖലീഫമാരും സ്വഹാബികളും മുഖേനയോ, നാല്
                                ഇമാമുമാർ (ഹനഫി, മാലികി, ശാഫിഈ, ഹൻബലി) മുഖേനയോ</strong> വിശുദ്ധ മാസം ആയി പറയപ്പെട്ടിട്ടില്ല.
                        </p>
                        <p class="mb-1">
                            🔹 എങ്കിലും, ചരിത്രപരമായി <strong>പ്രവാചകൻ (ﷺ) ജനിച്ച മാസം</strong> എന്ന നിലയിലാണ് റ. അവ്വൽ
                            മുസ്ലിം സമൂഹത്തിൽ പ്രസിദ്ധമായത്.
                        </p>
                        <hr>

                        <ul class="check-list m-0">
                            <li class="fst-italic mb-1">
                                “നിനക്ക് അറിവില്ലാത്ത യാതൊരു കാര്യത്തിന്‍റെയും പിന്നാലെ നീ പോകരുത്‌.” — <em
                                    class="fw-bold">S. 17:36</em>
                            </li>
                            <li class="fst-italic mb-1">
                                “നമ്മുടെ മതത്തിന്റെ തത്വങ്ങൾക്ക് നിരക്കാത്ത എന്തെങ്കിലും ആരെങ്കിലും പുതുതായി ഉണ്ടാക്കിയാൽ
                                അത് നിരസിക്കപ്പെടും.” — <em class="fw-bold">സഹീഹ് ബുഖാരി: 2697</em>
                            </li>
                            <li class="fst-italic mb-1">
                                “പുതുതായി കണ്ടുപിടിച്ച കാര്യങ്ങളെ സൂക്ഷിക്കുക, കാരണം അവ വഴിതെറ്റിയതാണ്. നിങ്ങളിൽ ആരെങ്കിലും
                                അത്
                                കാണുന്നുവെങ്കിൽ, അവൻ എന്റെ സുന്നത്തും സന്മാർഗ്ഗം പ്രാപിച്ച ഖുലഫയുടെ സുന്നത്തും മുറുകെ
                                പിടിക്കണം.” — <em class="fw-bold">ജാമി അൽ-തിർമിധി: 2676</em>
                            </li>
                            <li class="fst-italic mb-1">
                                “ക്രിസ്ത്യാനികൾ മർയമിന്റെ മകനെ പുകഴ്ത്തിയതുപോലെ എന്നെ പുകഴ്ത്തുന്നതിൽ നിങ്ങൾ അതിശയോക്തി
                                കാണിക്കരുത്,
                                കാരണം ഞാൻ ഒരു അടിമ മാത്രമാണ്.” — <em class="fw-bold">സഹീഹ് ബുഖാരി: 3445</em>
                            </li>
                        </ul>

                        <x-app.notice />
                    </div>

                    <div class="card-surface p-2 mb-3">
                        <h6 class="fw-bold text-primary">References</h6>

                        <article class="mt-2">
                            <div class="card-surface bg-light border">
                                <h6 class="text-primary fw-bold">ഇമാം അബൂ ഹനീഫ (80-150H)</h6>

                                <p class="m-0 fst-italic fw-bold">
                                    അദ്ദേഹത്തിന്റെ കാലത്തും (ഇമാം അബൂ യൂസുഫ്, ഇമാം മുഹമ്മദ്) പുസ്തകങ്ങളിലും റ.
                                    അവ്വൽ മാസത്തെ ശ്രേഷ്ഠമാക്കി കാണിച്ച പ്രവർത്തി ഒന്നും ഇല്ല.
                                </p>
                                <p class="small text-muted mb-2">
                                    ഹനഫി ഫിഖ്ഹ് ഗ്രന്ഥങ്ങളിൽ (ഉദാ: അൽ-ഹിദായ, അൽ-മബ്സൂത്) റ. അവ്വൽ മാസത്തെ പ്രത്യേക
                                    ആരാധന/ആഘോഷം ബിദ്അത് ആയി കണക്കാക്കുന്നു.
                                </p>
                            </div>
                        </article>

                        <article class="mt-2">
                            <div class="card-surface bg-light border">
                                <h6 class="text-primary fw-bold">ഇമാം മാലിക് (93-179H)</h6>

                                <p class="m-0 fst-italic fw-bold">
                                    അദ്ദേഹത്തോട് <strong>മൗലിദ് (പ്രവാചകന്റെ ജനനദിനാഘോഷം)</strong> സംബന്ധിച്ച് ചോദിച്ചപ്പോൾ,
                                    അദ്ദേഹം പറഞ്ഞു:
                                    <strong>അത് ആരും ചെയ്തിട്ടില്ല. അത് ബിദ്അത് ആണ്.</strong>
                                </p>
                                <p class="small text-muted mb-2">
                                    (റഫറൻസ്: അൽ-ഷാതിബി, അൽ-ഇ'തിസാം, വാള്യം 1/48).
                                </p>
                            </div>
                        </article>

                        <article class="mt-2">
                            <div class="card-surface bg-light border">
                                <h6 class="text-primary fw-bold">ഇമാം ശാഫിഈ (150–204H)</h6>

                                <p class="m-0 fst-italic fw-bold">
                                    ഒരു കാര്യത്തെ നല്ല ബിദ്അത് എന്നും, മോശം ബിദ്അത് എന്നും പറയാം. ഖുർആനും സുന്നത്തും
                                    വിരുദ്ധമല്ലെങ്കിൽ, അത് നല്ലതാണ്.
                                </p>
                                <p class="small text-muted mb-2">
                                    (റഫറൻസ്: അൽ-ബൈഹഖി, മനാഖിബ് അൽ-ശാഫിഈ 1/469).
                                </p>

                                <ul class="m-0">
                                    <li>പക്ഷേ റ. അവ്വൽ മാസത്തെ പ്രത്യേകിച്ച് ശ്രേഷ്ഠമാക്കീട്ടില്ല.</li>
                                    <li>
                                        പിന്നീട് ചില ശാഫിഈ ഉലമാക്കൾ (ഉദാ: <strong>ഇമാം നവവി, ഇമാം സുയൂതി</strong>) മൗലിദ്
                                        നല്ല ബിദ്അത് ആയി പറഞ്ഞിട്ടുണ്ട്, പക്ഷേ അത് <strong>ഇമാം ശാഫിഈയുടെ നേരിട്ട് നിലപാട്
                                            അല്ല.</strong>
                                    </li>
                                </ul>
                            </div>
                        </article>

                        <article class="mt-2">
                            <div class="card-surface bg-light border">
                                <h6 class="text-primary fw-bold">ഇമാം അഹ്മദ് ബിൻ ഹൻബൽ (164-241H)</h6>

                                <p class="m-0 fst-italic fw-bold">
                                    അദ്ദേഹത്തോട് മൗലിദ് സംബന്ധിച്ച് ചോദിച്ചപ്പോൾ:
                                    <strong>എനിക്ക് അത് ബിദ്അത് ആയി തോന്നുന്നു.</strong>
                                </p>
                                <p class="small text-muted mb-2">
                                    (റഫറൻസ്: ഇബ്ന് തൈമിയ്യ, ഇഖ്തിദാഉൽ സിറാത്ത് അൽ-മുസ്തഖീം 294).
                                </p>

                                <p class="m-0 fst-italic fw-bold">
                                    ഇമാം അഹ്മദിന്റെ (ഇബ്ന് ഖുദാമ, ഇബ്ന് തൈമിയ്യ, ഇബ്ന് അൽ-ജൗസി) എല്ലാം റ. അവ്വൽ
                                    മാസത്തെ പ്രത്യേകിച്ച് മഹത്വപ്പെടുത്തുന്നത് ബിദ്അത് എന്ന് വ്യക്തമാക്കിയിട്ടുണ്ട്.
                                </p>
                            </div>
                        </article>
                    </div>
                </article>
            </section>

            <!-- SIDEBAR -->
            <aside class="col-lg-4 position-sticky d-flex flex-column align-self-start gap-2" style="top:84px;">
                <div class="card-surface">
                    <h6 class="fw-bold text-primary">Quran reminder</h6>

                    <div class="text-center mx-auto mt-3">
                        <div class="ayah-card">
                            <h6 class="text-arabic text-primary fw-bold mt-2 lh-lg mb-0">
                                ﴿ وَلَا تَقْفُ مَا لَيْسَ لَكَ بِهِۦ عِلْمٌ ۚ ﴾
                            </h6>

                            <p class="fst-italic small m-0">
                                നിനക്ക് അറിവില്ലാത്ത യാതൊരു കാര്യത്തിന്‍റെയും പിന്നാലെ നീ പോകരുത്‌.
                            </p>

                            <p class="m-0 mt-1 text-muted small">S. 17:36</p>
                        </div>
                    </div>

                    <div class="text-center mx-auto mt-3">
                        <div class="ayah-card">
                            <h6 class="text-arabic text-primary fw-bold mt-2 lh-lg mb-0">
                                ﴿ وَتِلْكَ ٱلْأَمْثَٰلُ نَضْرِبُهَا لِلنَّاسِ ۖ وَمَا يَعْقِلُهَآ إِلَّا ٱلْعَٰلِمُونَ ﴾
                            </h6>

                            <p class="fst-italic small m-0">
                                ആ ഉപമകള്‍ നാം മനുഷ്യര്‍ക്ക് വേണ്ടി വിവരിക്കുകയാണ്‌. അറിവുള്ളവരല്ലാതെ അവയെപ്പറ്റി ചിന്തിച്ച്
                                മനസ്സിലാക്കുകയില്ല.
                            </p>

                            <p class="m-0 mt-1 text-muted small">S. 29:43</p>
                        </div>
                    </div>
                </div>

                <div class="card-surface d-none">
                    <h6 class="fw-bold text-primary">Trust & provenance</h6>
                    <div class="small text-muted">Editor: <strong>Editor Name</strong></div>
                    <div class="small text-muted">Verified: <strong>Yes</strong></div>
                    <div class="small text-muted">Last reviewed: <strong>{{ now()->format('M d, Y') }}</strong></div>

                    <div class="mt-2">
                        <button class="btn btn-outline-secondary btn-sm">View revision history</button>
                        <button class="btn btn-outline-success btn-sm">Copy citation</button>
                    </div>
                </div>

                <div class="card-surface">
                    <h6 class="fw-bold text-primary">Related topics</h6>
                    <ul class="small ps-3">
                        @foreach ($questions as $key => $item)
                            <li class="py-1">
                                <a class="text-primary"
                                    href="{{ route('answers.show', ['menu_slug' => 'festival', 'module_slug' => 'meelad', 'question_slug' => $key]) }}">
                                    {{ $item }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>
        </div>

        <article class="card-surface mt-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-primary fw-bold mb-0">നബിദിനം</h6>
                    <small class="d-block text-muted mt-1">
                        Asked by <strong>admin</strong> • {{ now()->format('M d, Y') }}
                    </small>
                </div>

                <button type="button" class="btn btn-outline-secondary btn-sm">
                    Share
                </button>
            </div>
        </article>
    </main>

    <button type="button"
        class="btn btn-success rounded-circle shadow-lg position-fixed bottom-0 m-4 mb-4 z-3 d-flex align-items-center justify-content-center"
        style="width: 40px; height: 40px;" data-bs-toggle="modal" data-bs-target="#quickSummaryModal"
        title="Quick Summary">
        <i class="fas fa-list-ul fa-lg"></i>
    </button>

    <button type="button" class="btn btn-warning rounded-pill position-fixed bottom-0 end-0 me-3 mb-5 z-3 d-none"
        id="backToTop">
        <i class="fas fa-arrow-up text-white"></i>
    </button>

    <button type="button" class="btn btn-secondary rounded-pill position-fixed bottom-0 end-0 me-3 mb-2 z-3"
        data-bs-toggle="modal" data-bs-target="#quranHadithModal">
        <i class="fas fa-book text-white"></i>
    </button>

    <div class="modal fade" id="quickSummaryModal" tabindex="-1" aria-labelledby="quickSummaryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header mb-2 position-sticky top-0 z-3 bg-white">
                    <h5 class="modal-title" id="quickSummaryModalLabel">Quick Summary - {{ array_keys($qst)[0] }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p class="mb-2">
                        🔹 റ. അവ്വൽ മാസം <strong>ഖുർആനിലോ, സഹീഹ് ഹദീസ് പ്രകാരമോ, ഖലീഫമാരും സ്വഹാബികളും മുഖേനയോ, നാല്
                            ഇമാമുമാർ (ഹനഫി, മാലികി, ശാഫിഈ, ഹൻബലി) മുഖേനയോ</strong> വിശുദ്ധ മാസം ആയി പറയപ്പെട്ടിട്ടില്ല.
                    </p>
                    <p class="mb-1">
                        🔹 എങ്കിലും, ചരിത്രപരമായി <strong>പ്രവാചകൻ (ﷺ) ജനിച്ച മാസം</strong> എന്ന നിലയിലാണ് റ. അവ്വൽ
                        മുസ്ലിം സമൂഹത്തിൽ പ്രസിദ്ധമായത്.
                    </p>
                    <hr>

                    <ul class="check-list m-0">
                        <li class="fst-italic mb-1">
                            “നിനക്ക് അറിവില്ലാത്ത യാതൊരു കാര്യത്തിന്‍റെയും പിന്നാലെ നീ പോകരുത്‌.” — <em class="fw-bold">S.
                                17:36</em>
                        </li>
                        <li class="fst-italic mb-1">
                            “നമ്മുടെ മതത്തിന്റെ തത്വങ്ങൾക്ക് നിരക്കാത്ത എന്തെങ്കിലും ആരെങ്കിലും പുതുതായി ഉണ്ടാക്കിയാൽ
                            അത് നിരസിക്കപ്പെടും.” — <em class="fw-bold">സഹീഹ് ബുഖാരി: 2697</em>
                        </li>
                        <li class="fst-italic mb-1">
                            “പുതുതായി കണ്ടുപിടിച്ച കാര്യങ്ങളെ സൂക്ഷിക്കുക, കാരണം അവ വഴിതെറ്റിയതാണ്. നിങ്ങളിൽ ആരെങ്കിലും
                            അത്
                            കാണുന്നുവെങ്കിൽ, അവൻ എന്റെ സുന്നത്തും സന്മാർഗ്ഗം പ്രാപിച്ച ഖുലഫയുടെ സുന്നത്തും മുറുകെ
                            പിടിക്കണം.” — <em class="fw-bold">ജാമി അൽ-തിർമിധി: 2676</em>
                        </li>
                        <li class="fst-italic mb-1">
                            “ക്രിസ്ത്യാനികൾ മർയമിന്റെ മകനെ പുകഴ്ത്തിയതുപോലെ എന്നെ പുകഴ്ത്തുന്നതിൽ നിങ്ങൾ അതിശയോക്തി
                            കാണിക്കരുത്,
                            കാരണം ഞാൻ ഒരു അടിമ മാത്രമാണ്.” — <em class="fw-bold">സഹീഹ് ബുഖാരി: 3445</em>
                        </li>
                    </ul>

                    <x-app.notice />
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myLgModal" tabindex="-1" aria-labelledby="myLgModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLgModalLabel">References</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body text-center">Reference Details</div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const backToTopBtn = document.getElementById("backToTop");

        // Show button after scrolling down 200px
        window.addEventListener("scroll", () => {
            if (window.scrollY > 200) {
                backToTopBtn.classList.remove("d-none");
            } else {
                backToTopBtn.classList.add("d-none");
            }
        });

        // Smooth scroll to top
        backToTopBtn.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    </script>
@endpush
