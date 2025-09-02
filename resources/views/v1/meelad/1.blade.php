@extends('layouts.app')

@section('content')
    @php
        $quickSummary = [
            'notes' => [
                'റ. അവ്വൽ മാസം <strong>ഖുർആനിലോ, സഹീഹ് ഹദീസ് പ്രകാരമോ, ഖലീഫമാരും സ്വഹാബികളും മുഖേനയോ, മദ്ഹബുകളുടെ ഇമാമുമാർ മുഖേനയോ</strong> വിശുദ്ധ മാസം ആയി പറയപ്പെട്ടിട്ടില്ല.',
                'എങ്കിലും, ചരിത്രപരമായി <strong>പ്രവാചകൻ (ﷺ) ജനിച്ച മാസം</strong> എന്ന നിലയിലാണ് റ. അവ്വൽ മുസ്ലിം സമൂഹത്തിൽ പ്രസിദ്ധമായത്.',
            ],
            'true' => 'പ്രവാചക ചര്യ (സുന്നത്ത്) തിങ്കളാഴ്ച നോമ്പാണ് (<em class="small">മുസ്ലിം: 2747</em>), ജന്മദിനാഘോഷമല്ല.',
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
                    <li class="breadcrumb-item active" aria-current="page">{{ array_keys($qst)[0] }}</li>
                </ol>
            </nav>

            <hr class="mt-1 mb-3">

            <div class="text-center">
                <h5 class="fw-bold text-primary text-Playfair text-tr m-0">{{ array_keys($qst)[0] }}</h5>
                <p class="text-muted m-0">
                    ഖുർആൻ, ഹദീസ്, പ്രാമാണിക തെളിവുകൾ ഉൾക്കൊള്ളുന്ന പ്രായോഗിക ഘട്ടം ഘട്ടമായുള്ള മാർഗനിർദേശം.
                </p>
            </div>
        </header>

        <div class="row g-2 my-1">
            <section class="col-lg-8">
                <article class="card-surface">
                    <x-app.topic-header :title="array_keys($qst)[0]" />

                    <hr class="mt-2 mb-3">

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

                    <x-app.quick-summary :data="$quickSummary" />

                    <div class="card-surface p-2 mb-3 mt-3">
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
                                    അദ്ദേഹത്തോട് <strong>മീലാദ് (പ്രവാചകന്റെ ജനനദിനാഘോഷം)</strong> സംബന്ധിച്ച് ചോദിച്ചപ്പോൾ,
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
                                        പിന്നീട് ചില ശാഫിഈ ഉലമാക്കൾ (ഉദാ: <strong>ഇമാം നവവി, ഇമാം സുയൂതി</strong>) മീലാദ്
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
                                    അദ്ദേഹത്തോട് മീലാദ് സംബന്ധിച്ച് ചോദിച്ചപ്പോൾ:
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
                    <h6 class="fw-bold text-primary">Quick reminder</h6>

                    <div class="text-center mx-auto mt-3">
                        <x-app.ayah-card :ayah="'ٱلْيَوْمَ أَكْمَلْتُ لَكُمْ دِينَكُمْ وَأَتْمَمْتُ عَلَيْكُمْ نِعْمَتِى وَرَضِيتُ لَكُمُ ٱلْإِسْلَٰمَ دِينًۭا ۚ'" :translation="'ഇന്ന് ഞാന്‍ നിങ്ങള്‍ക്ക് നിങ്ങളുടെ മതം പൂര്‍ത്തിയാക്കി തന്നിരിക്കുന്നു. എന്‍റെ അനുഗ്രഹം നിങ്ങള്‍ക്ക് ഞാന്‍ നിറവേറ്റിത്തരികയും ചെയ്തിരിക്കുന്നു. മതമായി ഇസ്ലാമിനെ ഞാന്‍ നിങ്ങള്‍ക്ക് തൃപ്തിപ്പെട്ട് തന്നിരിക്കുന്നു.'" :number="'5:3'" />
                    </div>

                    <div class="text-center mx-auto mt-3">
                        <x-app.ayah-card :ayah="'وَلَا تَقْفُ مَا لَيْسَ لَكَ بِهِۦ عِلْمٌ ۚ'" :translation="'നിനക്ക് അറിവില്ലാത്ത യാതൊരു കാര്യത്തിന്‍റെയും പിന്നാലെ നീ പോകരുത്‌.'" :number="'17:36'" />
                    </div>
                </div>

                <x-app.related-topics :data="$questions" />
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
        style="width: 40px; height: 40px;" data-bs-toggle="modal" data-bs-target="#quickSummaryModal" title="Quick Summary">
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
                <div class="modal-header position-sticky top-0 z-3 bg-white">
                    <h5 class="modal-title" id="quickSummaryModalLabel">{{ array_keys($qst)[0] }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <x-app.quick-summary :data="$quickSummary" class="rounded-0" />
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
