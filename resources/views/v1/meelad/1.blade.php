@extends('layouts.app')

@section('content')
    @php
        $quickSummary = [
            'notes' => [
                '<strong>നബി ﷺ</strong> തന്റെ ജന്മദിനം <strong>ആഘോഷിച്ചിട്ടില്ല</strong>.',
                '<strong>സഹാബികളും ഖലീഫാക്കളും</strong> (അബൂബക്കർ, ഉമർ, ഉസ്മാൻ, അലി) <strong>ആഘോഷിച്ചിട്ടില്ല</strong>.',
                '<strong>ഖുർആൻ</strong>–ൽ അതിനൊരു നിർദ്ദേശമില്ല.',
                '<strong>ഹദീസ്</strong>: നബി ﷺ തിങ്കളാഴ്ച നോമ്പ് എടുക്കാറുണ്ടായിരുന്നു - <em class="text-muted small"> മുസ്ലിം: 2747.</em>',
                '<strong>മദ്ഹബുകളുടെ ഇമാമുമാർ</strong>: അവരുടെ കാലത്ത് ആഘോഷങ്ങൾ സ്ഥിരമായിട്ടില്ല.',

                '<strong>പ്രവാചകൻ ﷺ ജനിച്ച മാസം</strong> എന്ന നിലയിലാണ് റ. അവ്വൽ മുസ്ലിം സമൂഹത്തിൽ
                പ്രസിദ്ധമായത്.',

                '<strong>നബി ﷺ ജനിച്ച തീയതി സംബന്ധിച്ച് (8, 9, 12) തുടങ്ങിയ വ്യത്യസ്ത അഭിപ്രായങ്ങൾ ഉണ്ടെങ്കിലും,</strong>
                12-ാം തീയതി പ്രധാന അഭിപ്രായമായി അറിയപ്പെടുന്നു.',

                '<strong>അബ്ബാസി, ഫാത്തിമി </strong> കാലഘട്ടങ്ങളിൽ (~500H) <strong>മീലാദ് തുടങ്ങുമ്പോൾ റ.അവ്വൽ 12 സ്വീകരിച്ചു.</strong>',

                '<strong>പിന്നീട് വന്നിട്ടുള്ള കാലഘട്ടങ്ങളിൽ മീലാദ് ആഘോഷമായും, ആചാരമായും പ്രചരിച്ചു.</strong>',
            ],
            'true' => 'പ്രവാചക ചര്യ (സുന്നത്ത്) തിങ്കളാഴ്ച നോമ്പാണ് - <em class="small">മുസ്ലിം: 2747</em>.',
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

        <div class="position-sticky z-3 card-surface bg-success-subtle mt-2 rounded-0 b-accent shadow-sm d-md-none d-sm-block"
            style="top: 72px;">
            <h6 class="text-primary fw-bold m-0 text-center">{{ array_keys($qst)[0] }}</h6>
        </div>

        <div class="row g-2 mt-2">
            <section class="col-lg-8">
                <article class="card-surface">
                    <x-app.topic-header :title="array_keys($qst)[0]" />

                    <hr class="mt-2 mb-3">

                    @foreach (array_values($qst)[0] as $key => $item)
                        <div class="step-card mb-2">
                            <div class="num-card">{{ $key + 1 }}</div>
                            <div class="flex-1">
                                <div class="fw-bold">{!! $item !!}</div>
                                @if ($key == 0)
                                    <p class="small m-0">ഖുർആനിൽ പ്രത്യേക പരാമർശമില്ല.</p>
                                @endif

                                @if ($key == 1)
                                    <ul class="m-0 p-0 ps-3 small">
                                        <li>സഹീഹ് ഹദീസുകളിൽ പ്രത്യേക പരാമർശമില്ല.</li>
                                        <li>
                                            <strong>നബി ﷺ ജനിച്ചത് തിങ്കളാഴ്ച</strong> എന്ന് പറയപ്പെട്ടിട്ടുണ്ട്. - <em
                                                class="fst-italic text-muted">മുസ്ലിം: 2747</em>
                                        </li>
                                    </ul>
                                @endif

                                @if ($key == 2)
                                    <p class="small m-0">
                                        <span class="text-muted">അബൂബക്കർ(റ), ഉമർ (റ), ഉസ്മാൻ (റ), അലി (റ)</span>
                                        എന്നിവർ പ്രവാചകൻ ﷺ ജനിച്ച ദിവസം ആഘോഷിക്കുകയോ, പ്രത്യേകിച്ച് വാഴ്ത്തുകയോ
                                        ചെയ്തിട്ടില്ല.
                                    </p>
                                @endif

                                @if ($key == 3)
                                    <span class='fst-italic small text-muted'>(ഇമാം അബൂ ഹനീഫ, മാലിക്, ശാഫിഈ, ഹൻബലി)</span>
                                    <p class="small m-0">
                                        മദ്ഹബുകളുടെ ഇമാമുമാരുടെ </strong> നിലപാട് നോക്കുമ്പോൾ, അവരുടെ കാലത്ത്
                                        <strong>ഈ മാസത്തെ പ്രത്യേകമായി മഹത്വപ്പെടുത്തിയ പ്രവർത്തി ഒന്നും ഇല്ല.</strong>
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <x-app.quick-summary :data="$quickSummary" />

                    <div class="card-surface bg-light border mt-3">
                        <h6 class="fw-bold text-primary">12-ാം തീയതി വന്ന പ്രധാന ഉറവിടം</h6>

                        <article class="mt-2">
                            <ul class="m-0">
                                <li class="mb-1">നബി ﷺ ജനിച്ച തീയതി ഒരൊറ്റ അഭിപ്രായമല്ല.</li>
                                <li class="mb-1">
                                    ചരിത്രകാരന്മാരും ഹദീസ്-ഉലമാക്കളും പല തീയതികൾ പറഞ്ഞു:
                                    <em class="small text-muted">(8 ഇബ്ന്‍ ഹസ്മ്, 9 ഇബ്ന്‍ ദിഹ്യ, 12 ഇബ്ന്‍ ഇഷാഖ്)</em>
                                </li>
                                <li class="mb-1">
                                    ഹദീസിൽ “നബി ﷺ തിങ്കളാഴ്ച ജനിച്ചു” (<em class="small text-muted">മുസ്ലിം: 2747</em>).
                                    <strong>ദിവസം ഉറപ്പാണ് (തിങ്കൾ), തീയതി ഉറപ്പില്ല.</strong>
                                </li>
                                <li class="mb-1">
                                    ഇബ്ന്‍ കതീർ: ഏറ്റവും പ്രശസ്തമായ അഭിപ്രായം 12 എന്നു പറയുന്നു.
                                    <em class="small text-muted">(البداية والنهاية 3/375)</em>.
                                    <br>അദ്ദേഹം തന്നെ പറയുന്നു: മറ്റ് അഭിപ്രായങ്ങളും ശക്തമാണ്.
                                </li>
                                <li class="mb-1">
                                    ജനറൽ മുസ്ലിം ലോകത്ത് ഇബ്ന്‍ ഇഷാഖ് പറഞ്ഞ 12 പ്രശസ്ത അഭിപ്രായം ആയി മാറി.
                                </li>
                                <li class="mb-1">
                                    അബ്ബാസി, ഫാത്തിമി (~300H - 700H) കാലഘട്ടങ്ങളിൽ മീലാദ് തുടങ്ങുമ്പോൾ ഒറ്റ തീയതി
                                    വേണമായിരുന്നു. അവർ
                                    റ.അവ്വൽ 12 സ്വീകരിച്ചു. 12 ഏറ്റവും പ്രചരിച്ചിരുന്ന അഭിപ്രായം ആയിരുന്നു.
                                </li>
                                <li class="mb-1">
                                    അതിനുശേഷം മിക്ക ചരിത്രകാരന്മാരുടെയും ഗ്രന്ഥങ്ങളിൽ 12 പ്രധാന തീയതി ആയി
                                </li>
                                <li>ജനനവും വഫാതും രണ്ടും റ.അ. 12 എന്നാണ് ചില ചരിത്രകാരന്മാർ പറയുന്നത്.</li>
                            </ul>
                        </article>
                    </div>

                    <div class="card-surface bg-light border p-2 mt-3">
                        <h6 class="fw-bold text-primary">References</h6>
                        <hr class="m-0 my-1">

                        <article class="mt-3">
                            <h6 class="text-primary fw-bold">ഇമാം അബൂ ഹനീഫ (80 - 150H)</h6>

                            <p class="m-0">
                                അദ്ദേഹത്തിന്റെ കാലത്തും (ഇമാം അബൂ യൂസുഫ്, ഇമാം മുഹമ്മദ്) പുസ്തകങ്ങളിലും റ.
                                അവ്വൽ മാസത്തെ ശ്രേഷ്ഠമാക്കി കാണിച്ച പ്രവർത്തി ഒന്നും ഇല്ല.
                            </p>
                            <p class="small text-muted m-0">
                                ഹനഫി ഫിഖ്ഹ് ഗ്രന്ഥങ്ങളിൽ (ഉദാ: അൽ-ഹിദായ, അൽ-മബ്സൂത്) റ. അവ്വൽ മാസത്തെ പ്രത്യേക
                                ആരാധന/ആഘോഷം ബിദ്അത് ആയി കണക്കാക്കുന്നു.
                            </p>
                        </article>

                        <div class="geo-divider my-2"></div>

                        <article class="mt-2">
                            <h6 class="text-primary fw-bold">ഇമാം മാലിക് (93 - 179H)</h6>

                            <p class="m-0">
                                അദ്ദേഹത്തോട് മീലാദ് (പ്രവാചകന്റെ ജനനദിനാഘോഷം) സംബന്ധിച്ച് ചോദിച്ചപ്പോൾ,
                                അദ്ദേഹം പറഞ്ഞു: അത് ആരും ചെയ്തിട്ടില്ല. അത് ബിദ്അത് ആണ്.
                            </p>
                            <p class="small text-muted m-0">
                                (റഫറൻസ്: അൽ-ഷാതിബി, അൽ-ഇ'തിസാം, വാള്യം 1/48).
                            </p>
                        </article>

                        <div class="geo-divider my-2"></div>

                        <article class="mt-2">
                            <h6 class="text-primary fw-bold">ഇമാം ശാഫിഈ (150 - 204H)</h6>

                            <p class="m-0">
                                ഒരു കാര്യത്തെ നല്ല ബിദ്അത് എന്നും, മോശം ബിദ്അത് എന്നും പറയാം. ഖുർആനും സുന്നത്തും
                                വിരുദ്ധമല്ലെങ്കിൽ, അത് നല്ലതാണ്.
                            </p>
                            <p class="small text-muted m-0">
                                (റഫറൻസ്: അൽ-ബൈഹഖി, മനാഖിബ് അൽ-ശാഫിഈ 1/469).
                            </p>

                            <ul class="m-0 fst-italic small">
                                <li>പക്ഷേ റ. അവ്വൽ മാസത്തെ പ്രത്യേകിച്ച് ശ്രേഷ്ഠമാക്കീട്ടില്ല.</li>
                                <li>
                                    പിന്നീട് ചില ശാഫിഈ ഉലമാക്കൾ (ഉദാ: ഇമാം നവവി, ഇമാം സുയൂതി) മീലാദ് നല്ല ബിദ്അത് ആയി
                                    പറഞ്ഞിട്ടുണ്ട്, പക്ഷേ അത് ഇമാം ശാഫിഈയുടെ നേരിട്ട് നിലപാട് അല്ല.
                                </li>
                            </ul>
                        </article>

                        <div class="geo-divider my-2"></div>

                        <article class="mt-2">
                            <h6 class="text-primary fw-bold">ഇമാം അഹ്മദ് ബിൻ ഹൻബൽ (164 - 241H)</h6>

                            <p class="m-0">
                                അദ്ദേഹത്തോട് മീലാദ് സംബന്ധിച്ച് ചോദിച്ചപ്പോൾ: എനിക്ക് അത് ബിദ്അത് ആയി തോന്നുന്നു.
                            </p>
                            <p class="small text-muted m-0">
                                (റഫറൻസ്: ഇബ്ന് തൈമിയ്യ, ഇഖ്തിദാഉൽ സിറാത്ത് അൽ-മുസ്തഖീം 294).
                            </p>

                            <p class="m-0 fst-italic m-0 small">
                                ഇമാം അഹ്മദിന്റെ (ഇബ്ന് ഖുദാമ, ഇബ്ന് തൈമിയ്യ, ഇബ്ന് അൽ-ജൗസി) എല്ലാം റ. അവ്വൽ
                                മാസത്തെ പ്രത്യേകിച്ച് മഹത്വപ്പെടുത്തുന്നത് ബിദ്അത് എന്ന് വ്യക്തമാക്കിയിട്ടുണ്ട്.
                            </p>
                        </article>
                    </div>
                </article>
            </section>

            <!-- SIDEBAR -->
            <aside class="col-lg-4 position-sticky d-flex flex-column align-self-start gap-2" style="top:84px;">
                <div class="card-surface">
                    <h6 class="fw-bold text-primary mb-3">
                        Trust & reminder
                        <button type="button" class="btn btn-secondary btn-sm rounded-pill" data-bs-toggle="modal"
                            data-bs-target="#quranHadithModal">
                            <i class="fas fa-book text-white"></i>
                        </button>
                    </h6>

                    <div class="text-center mx-auto mb-2">
                        <x-app.ayah-card :translation="'നിനക്ക് അറിവില്ലാത്ത യാതൊരു കാര്യത്തിന്‍റെയും പിന്നാലെ നീ പോകരുത്‌.'" :number="'S. 17:36'" />
                    </div>

                    <div class="text-center mx-auto mb-2">
                        <x-app.ayah-card :translation="'ഇന്ന് ഞാന്‍ നിങ്ങള്‍ക്ക് നിങ്ങളുടെ മതം പൂര്‍ത്തിയാക്കി തന്നിരിക്കുന്നു. മതമായി ഇസ്ലാമിനെ ഞാന്‍ നിങ്ങള്‍ക്ക് തൃപ്തിപ്പെട്ട് തന്നിരിക്കുന്നു.'" :number="'S. 5:3'" />
                    </div>

                    <div class="text-center mx-auto mb-2">
                        <x-app.ayah-card class="bg-light" :translation="'(തിങ്കളാഴ്ച നോമ്പിനെ കുറിച് ചോദിക്കപ്പെട്ടപ്പോൾ): ഞാൻ ജനിച്ച ദിവസമായിരുന്നു അത്. അന്ന് എനിക്ക് പ്രവാചകത്വം നൽകുകയോ എനിക്ക് ദിവ്യബോധനം നൽകുകയോ ചെയ്തു.'" :number="'മുസ്ലിം: 2747'" />
                    </div>

                    <div class="text-center mx-auto">
                        <x-app.ayah-card class="bg-light" :translation="'പുതുതായി കണ്ടുപിടിച്ച കാര്യങ്ങളെ സൂക്ഷിക്കുക, അവ വഴിതെറ്റിയതാണ്. നിങ്ങളിൽ ആരെങ്കിലും അത് കാണുന്നുവെങ്കിൽ, അവൻ എന്റെ സുന്നത്തും സന്മാർഗ്ഗം പ്രാപിച്ച ഖുലഫയുടെ സുന്നത്തും മുറുകെ പിടിക്കണം.'" :number="'തിർമിധി: 2676'" />
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
                    <h6 class="modal-title text-primary m-0" id="quickSummaryModalLabel">{{ array_keys($qst)[0] }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <x-app.quick-summary :data="$quickSummary" class="p-2" />
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
