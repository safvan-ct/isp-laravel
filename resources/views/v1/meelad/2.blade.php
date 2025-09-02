@extends('layouts.app')

@section('content')
    @php
        $quickSummary = [
            'notes' => [
                '<strong>ഖുർആനിലോ, സഹീഹ് ഹദീസ് പ്രകാരമോ, ഖലീഫമാരും സ്വഹാബികളും മുഖേനയോ, നാല് ഇമാമുമാർ (ഹനഫി, മാലികി, ശാഫിഈ, ഹൻബലി) മുഖേനയോ</strong> വഴി 12 എന്നത് സ്ഥിരമായിട്ടില്ല.',
                'നബി ﷺ ജനിച്ച കൃത്യമായ തിയ്യതിയെക്കുറിച്ച് ചരിത്രകാരന്മാര്‍ക്കിടയില്‍ <strong>അഭിപ്രായവ്യത്യാസമുണ്ട് (8, 9, 12 എന്നിവ പറയപ്പെടുന്നു).</strong> എങ്കിലും, ചരിത്രകാരന്മാർക്കിടയിൽ <strong>12 പ്രധാന അഭിപ്രായം</strong> ആയി മാറി.',
                '<strong>അബ്ബാസി, ഫാത്തിമി</strong> കാലഘട്ടങ്ങളിൽ <strong>മീലാദ് തുടങ്ങുമ്പോൾ, ജനങ്ങൾക്ക് ഒരൊറ്റ തീയതി വേണമായിരുന്നു. അവർ 12 റ.അ. സ്വീകരിച്ചു</strong> → കാരണം അത് ഏറ്റവും പ്രചരിച്ചിരുന്ന അഭിപ്രായം ആയിരുന്നു.',
                'നബി ﷺ പറഞ്ഞത്: “ഞാന്‍ തിങ്കളാഴ്ച നോമ്പുവയ്ക്കുന്നത്, ആ ദിവസം തന്നെയാണ് ഞാന്‍ ജനിച്ചതും എനിക്കു വഹ്‌യി വന്നതും ആയതു കൊണ്ടാണ്.” (സഹീഹ് മുസ്ലിം: 2747)',
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
                                        റ. അവ്വൽ 12 നെ <strong> കുറിച്ച് ഖുർആനിൽ നേരിട്ട് പരാമർശമില്ല.</strong>
                                    </p>
                                @endif

                                @if ($key == 1)
                                    <p class="small text-muted m-0">
                                        ജന്മദിനവുമായി ബന്ധപ്പെട്ട് സഹീഹ് ഹദീസ് <strong>പ്രത്യക്ഷമായി 12-ാം തീയതി
                                            പറയുന്നില്ല.</strong> പക്ഷേ <strong>ജനിച്ച ദിവസം (തിങ്കളാഴ്ച)</strong>
                                        സംബന്ധിച്ച തെളിവ് സഹീഹ് മുസ്ലിം ഉണ്ട്.
                                        - <i class="fw-bold text-muted small">{{ __('app.hadith') }} • സഹീഹ് മുസ്ലിം:
                                            2747</i>
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
                                        മദ്ഹബുകളുടെ ഇമാമുമാർ (ഇമാം അബൂ ഹനീഫ, ഇമാം മാലിക്, ഇമാം ശാഫിഈ, ഇമാം ഹൻബലി) ഇവരിൽ ആരും
                                        <strong>മീലാദ് (ജന്മദിനാചരണം) ചെയ്യുക, 12-ാം തീയതിക്ക് ശ്രേഷ്ഠത നൽകുക</strong>
                                        എന്നൊന്നും പറഞ്ഞിട്ടില്ല.
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <x-app.quick-summary :data="$quickSummary" />

                    <div class="card-surface mb-3">
                        <h6 class="fw-bold text-primary">12-ാം തീയതി വന്ന പ്രധാന ഉറവിടം</h6>

                        <article class="mt-2">
                            <div class="card-surface bg-light border">
                                <ul class="m-0 mb-2">
                                    <li>നബി ﷺ ജനിച്ച തീയതി ഒരൊറ്റ അഭിപ്രായമല്ല.</li>
                                    <li>
                                        ചരിത്രകാരന്മാരും ഹദീസ്-ഉലമാക്കളും പല തീയതികൾ പറഞ്ഞു:
                                        <em class="small text-muted">8 (ഇബ്ന്‍ ഹസ്മ്), 9 (ഇബ്ന്‍ ദിഹ്യ), 12 (ഇബ്ന്‍
                                            ഇഷാഖ്)</em>
                                    </li>
                                    <li>
                                        ഹദീസിൽ “നബി ﷺ തിങ്കളാഴ്ച ജനിച്ചു” (<em class="small text-muted">മുസ്ലിം: 2747</em>).
                                        <strong>ദിവസം ഉറപ്പാണ് (തിങ്കൾ), തീയതി ഉറപ്പില്ല.</strong>
                                    </li>
                                </ul>

                                <ul class="m-0">
                                    <li>
                                        ഇബ്ന്‍ ഇഷാഖ്: <em class="small text-muted">(d. 150H)</em> നബി ﷺ റ. അവ്വലിൽ 12 ന്
                                        ജനിച്ചു എന്ന് പറയുന്നു. <em class="small text-muted">(ഇബ്ന്‍ ഹിഷാം, السيرة النبوية,
                                            1/227).</em> <strong> റിവായത്ത് “മുർഷൽ/മുന്‍കതിഅ്” (സനദ് പൂർണ്ണമല്ല).</strong>
                                    </li>
                                    <li>
                                        ഇബ്ന്‍ കതീർ: ഏറ്റവും പ്രശസ്തമായ അഭിപ്രായം 12 എന്നു പറയുന്നു.
                                        <em class="small text-muted">(البداية والنهاية 3/375)</em>. അദ്ദേഹം തന്നെ പറയുന്നു:
                                        <strong>മറ്റ് അഭിപ്രായങ്ങളും ശക്തമാണ്.</strong>
                                    </li>
                                    <li>ജനറൽ മുസ്ലിം ലോകത്ത് ഇബ്ന്‍ ഇഷാഖ് പറഞ്ഞ 12 പ്രശസ്ത അഭിപ്രായം ആയി മാറി.
                                    </li>
                                    <li>
                                        അബ്ബാസി, ഫാത്തിമി കാലഘട്ടങ്ങളിൽ മീലാദ് തുടങ്ങുമ്പോൾ, ജനങ്ങൾക്ക് ഒരൊറ്റ തീയതി
                                        വേണമായിരുന്നു. അവർ 12 റ.അ. സ്വീകരിച്ചു <strong>കാരണം അത് ഏറ്റവും പ്രചരിച്ചിരുന്ന
                                            അഭിപ്രായം ആയിരുന്നു.</strong>
                                    </li>
                                    <li>അതിനുശേഷം മിക്ക ചരിത്രകാരന്മാരുടെയും ഗ്രന്ഥങ്ങളിൽ 12 പ്രധാന തീയതി ആയി</li>
                                    <li>ജനനവും വഫാതും രണ്ടും റ.അ. 12 എന്നാണ് ചില ചരിത്രകാരന്മാർ പറയുന്നത്.</li>
                                </ul>
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

        <x-app.share :title="array_keys($qst)[0]" />
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

                <x-app.quick-summary :data="$quickSummary" :class="'rounded-0'" />
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
