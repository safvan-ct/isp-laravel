@extends('layouts.app')

@section('content')
    @php
        $quickSummary = [
            'notes' => [
                '<strong>പ്രവാചകൻ ﷺ</strong> തന്റെ ജന്മദിനം <strong>ആഘോഷിച്ചിട്ടില്ല</strong>.',
                '<strong>സഹാബികളും ഖലീഫാക്കളും</strong> (അബൂബക്കർ, ഉമർ, ഉസ്മാൻ, അലി) <strong>ആഘോഷിച്ചിട്ടില്ല</strong>.',
                '<strong>ഖുർആൻ</strong>–ൽ അതിനൊരു നിർദ്ദേശമില്ല.',
                '<strong>ഹദീസ്</strong>: പ്രവാചകൻ ﷺ തിങ്കളാഴ്ച നോമ്പ് നോൽക്കാറുണ്ടായിരുന്നു - <em class="text-muted small"> മുസ്ലിം: 2747.</em>',
                '<strong>മദ്ഹബുകളുടെ ഇമാമുമാർ</strong>: അവരുടെ കാലത്ത് ആഘോഷങ്ങൾ സ്ഥിരമായിട്ടില്ല.',

                '<strong>പിന്നീട് വന്നിട്ടുള്ള ചില പണ്ഡിതന്മാർ ഹറാം കാര്യങ്ങളില്ലാതെ</strong>, ഖുർആൻ, സലാത്ത്, ദുആ, നബി ചരിത്രം
                പഠിക്കൽ, ഭക്ഷണം വിതരണം മുതലായവയ്ക്കായി നടത്തിയാൽ അത് <strong>ബിദ്അത് ഹസന (നല്ല പുതുമ)</strong> ആണെന്ന്
                അഭിപ്രായപ്പെടുന്നു.',

                '<strong>ചില പണ്ഡിതന്മാർ ഇത് ബിദ്അത് (പുതുമ) ആയതിനാൽ ഒഴിവാക്കണം</strong> എന്ന് അഭിപ്രായപ്പെടുന്നു.',
            ],
            'true' =>
                'പ്രവാചക ചര്യ (സുന്നത്ത്) തിങ്കളാഴ്ച നോമ്പാണ് (<em class="small">മുസ്ലിം: 2747</em>), ജന്മദിനാഘോഷമല്ല.',

            'good' => '<b>നബി ദിനം ആഘോഷിക്കാത്തത് ഇസ്‌ലാമിക വിരോധമല്ല.</b>
                <br><span class="fst-italic small text-muted">എന്റെ സുന്നത്തും സന്മാർഗ്ഗം പ്രാപിച്ച ഖുലഫയുടെ സുന്നത്തും മുറുകെ പിടിക്കണം. — <em class="small">തിർമിധി: 2676</em><span>',

            'bad' => 'പുതുതായി കൂട്ടിച്ചേർക്കലുകൾ <span class="fst-italic small text-muted">(പ്രതേക വിരുന്ന്, ഗാനങ്ങൾ, ചടങ്ങുകൾ, മൗലിദ് സദസ്സ്,
                 ലൈറ്റുകൾ, കൂട്ടം ചേർന്ന് ആഘോഷിക്കൽ)</span> ചര്യയല്ല ബിദ്അത് ആണ്.
                 <p class="fst-italic m-0 my-2 text-muted small">പുതുതായി കണ്ടുപിടിച്ച കാര്യങ്ങളെ സൂക്ഷിക്കുക, അവ വഴിതെറ്റിയതാണ്.
                        — <em class="small">തിർമിധി: 2676</em></p>
                    <p class="fst-italic m-0 text-muted small">ക്രിസ്ത്യാനികൾ മർയമിന്റെ മകനെ പുകഴ്ത്തിയതുപോലെ എന്നെ നിങ്ങൾ പുകഴ്ത്തരുത്.
                        — <em class="small">ബുഖാരി: 3445</em></p>',

            'alert' => 'ആചാരമാക്കുന്നവര്‍ ശുദ്ധമായ തൗഹീദിലും സുന്നത്തിലുമുള്ള മാര്‍ഗ്ഗങ്ങളില്‍ നില്‍ക്കുക. തെറ്റായ കൂട്ടിച്ചേർക്കലുകൾ ഹറാമായ പ്രവർത്തികൾ ഒഴിവാക്കുക.
                <br><b>നിനക്ക് അറിവില്ലാത്ത യാതൊരു കാര്യത്തിന്‍റെയും പിന്നാലെ നീ പോകരുത്‌. — <em class="small">S. 17:36</em></b>',
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
                                    <p class="small text-muted m-0 mb-2">
                                        <strong>ഖുർആനിൽ നേരിട്ടുള്ള പരാമർശമില്ല.</strong>
                                    </p>
                                    <div class="small m-0">
                                        എന്നാൽ, ചില പണ്ഡിതന്മാർ താഴെക്കാണുന്ന ഖുർആൻ ആയത്തുകൾ ചൂണ്ടിക്കാണിച്ച് നബി ﷺ യുടെ
                                        ജനനത്തിന്റെ മഹത്ത്വം വ്യക്തമാക്കുന്നു:
                                        <p class="small text-muted m-0 fst-italic mt-2 mb-1">
                                            “ലോകര്‍ക്ക് കാരുണ്യമായിക്കൊണ്ടല്ലാതെ നിന്നെ നാം അയച്ചിട്ടില്ല.” -S. (21:107)
                                        </p>
                                        <p class="small text-muted m-0 fst-italic mb-1">
                                            "തീര്‍ച്ചയായും അല്ലാഹുവും അവന്‍റെ മലക്കുകളും നബിയോട് കാരുണ്യം കാണിക്കുന്നു.
                                            സത്യവിശ്വാസികളേ, നിങ്ങള്‍ അദ്ദേഹത്തിന്‍റെ മേല്‍ (അല്ലാഹുവിന്‍റെ) കാരുണ്യവും
                                            ശാന്തിയുമുണ്ടാകാന്‍ പ്രാര്‍ത്ഥിക്കുക." -S. (33:56)
                                        </p>
                                        <p class="small text-muted m-0 fst-italic">
                                            "അല്ലാഹുവിന്‍റെ അനുഗ്രഹം കൊണ്ടും കാരുണ്യം കൊണ്ടുമാണത്‌. അതുകൊണ്ട് അവര്‍
                                            സന്തോഷിച്ചു കൊള്ളട്ടെ." -S. (10:58)
                                        </p>
                                    </div>
                                @endif

                                @if ($key == 1)
                                    <p class="small m-0">സഹീഹ് ഹദീസുകളിൽ പ്രത്യേക പരാമർശമില്ല.</p>
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

                    <div class="card-surface bg-light mt-3">
                        <h6 class="fw-bold text-primary">ചരിത്രപരമായ ഉത്ഭവം</h6>
                        <article class="mt-3">
                            <ol class="m-0">
                                <li class="mb-2">
                                    <h6 class="fw-bold">ഇസ്ലാമിക കാലഘട്ടത്തിലെ ആദ്യകാലം</h6>
                                    <ol style="list-style-type: lower-alpha">
                                        <li>
                                            <p class="fst-italic m-0 text-muted">
                                                പ്രവാചകൻ ﷺ യുടെ സഹാബികൾ നേരിട്ട് മീലാദ് ആഘോഷിച്ചിട്ടില്ല.
                                            </p>
                                        </li>
                                        <li>
                                            <p class="fst-italic m-0 text-muted">
                                                അവർ പ്രവാചകനെ സ്മരിച്ച് സലാത്ത് പറയുന്നതിലും, നബി ﷺ അനുഗ്രഹങ്ങൾ
                                                അനുഭവിക്കുന്നതിലും ശ്രദ്ധിച്ചുകൊണ്ടിരുന്നു.
                                            </p>
                                        </li>
                                    </ol>
                                </li>
                                <li class="mb-2">
                                    <h6 class="fw-bold">ഇബ്‌നു മുബാറക് (170 - 279 ഹിജ്റ) കാലഘട്ടം</h6>
                                    <ol style="list-style-type: lower-alpha">
                                        <li>
                                            <p class="fst-italic m-0 text-muted">
                                                മീലാദിനെ കുറിച്ച് ഒരു ചെറിയ പാരായണ ആചാരം ചില മുസ്ലിം സമൂഹങ്ങളിൽ രൂപപ്പെട്ടു.
                                            </p>
                                        </li>
                                        <li>
                                            <p class="fst-italic m-0 text-muted">
                                                ഇതിന് പ്രധാന ഉദ്ദേശം നബി ﷺയുടെ മഹിമ സ്മരിക്കുകയും, ഇസ്ലാമിക പാഠങ്ങൾ
                                                പൊതുജനങ്ങൾക്ക് പഠിപ്പിക്കുകയും ചെയ്യുക ആയിരുന്നു.
                                            </p>
                                        </li>
                                    </ol>
                                </li>
                                <li class="mb-2">
                                    <h6 class="fw-bold">ഫാത്തിമി കാലഘട്ടം (390 - 600 ഹിജ്റ)</h6>
                                    <ol style="list-style-type: lower-alpha">
                                        <li>
                                            <p class="fst-italic m-0 text-muted">
                                                മീലാദ് ആഘോഷത്തിന്റെ സമ്പൂർണ ആചാരം ഫാത്തിമി സുല്‍ത്താനുമാരുടെ ഭരണകാലത്ത്
                                                വ്യാപിച്ചു.
                                            </p>
                                        </li>
                                        <li>
                                            <p class="fst-italic m-0 text-muted">
                                                ഖുർആൻ പാരായണം, സലാത്ത്, മൗലിദ്, നബി ﷺ ജനനകഥ, പൊതുഭക്ഷണം എന്നിവ ഈ സമയത്ത്
                                                പ്രധാന ഘടകങ്ങളായി.
                                            </p>
                                        </li>
                                    </ol>
                                </li>
                                <li class="mb-2">
                                    <h6 class="fw-bold">ഒടുവിൽ ഓട്ടോമൻ കാലഘട്ടം, അറബ് ലോകം, ഇന്ത്യ</h6>
                                    <ol style="list-style-type: lower-alpha">
                                        <li>
                                            <p class="fst-italic m-0 text-muted">
                                                മീലാദ് വലിയ ആഘോഷമായി മസ്ജിദുകളിൽ, പ്രാദേശിക സ്ഥലങ്ങളിൽ വ്യാപിച്ചു.
                                            </p>
                                        </li>
                                        <li>
                                            <p class="fst-italic m-0 text-muted">
                                                ഇന്ത്യയിൽ (300 വർഷമായി) സൂഫി ശാഖകൾ മീലാദ് ആഘോഷിക്കുന്നതിൽ മുന്നേറ്റം നടത്തി.
                                            </p>
                                        </li>
                                    </ol>
                                </li>
                                <li class="">
                                    <h6 class="fw-bold">മക്ക, മദീന</h6>
                                    <ol style="list-style-type: lower-alpha">
                                        <li>
                                            <p class="fst-italic m-0 text-muted">
                                                1924-ൽ (1342H) സൗദി ഭരണാധികാരം വന്നതോടെ, നബിദിനം ബിദ്അത് എന്ന് പറഞ്ഞ് പൊതു
                                                ആഘോഷം നിരോധിച്ചു.
                                            </p>
                                        </li>
                                    </ol>
                                </li>
                            </ol>
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

                    <div class="text-center mx-auto mb-2">
                        <x-app.ayah-card class="bg-light" :translation="'പുതുതായി കണ്ടുപിടിച്ച കാര്യങ്ങളെ സൂക്ഷിക്കുക, അവ വഴിതെറ്റിയതാണ്. നിങ്ങളിൽ ആരെങ്കിലും അത് കാണുന്നുവെങ്കിൽ, അവൻ എന്റെ സുന്നത്തും സന്മാർഗ്ഗം പ്രാപിച്ച ഖുലഫയുടെ സുന്നത്തും മുറുകെ പിടിക്കണം.'" :number="'തിർമിധി: 2676'" />
                    </div>

                    <div class="text-center mx-auto">
                        <x-app.ayah-card class="bg-light" :translation="'ക്രിസ്ത്യാനികൾ മർയമിന്റെ മകനെ പുകഴ്ത്തിയതുപോലെ എന്നെ പുകഴ്ത്തുന്നതിൽ നിങ്ങൾ അതിശയോക്തി കാണിക്കരുത്, കാരണം ഞാൻ ഒരു അടിമ മാത്രമാണ്. അതിനാൽ എന്നെ അല്ലാഹുവിന്റെ അടിമയെന്നും അവന്റെ ദൂതനെന്നും വിളിക്കൂ.'" :number="'ബുഖാരി: 3445'" />
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
                    <h6 class="modal-title text-primary m-0" id="quickSummaryModalLabel">{{ array_keys($qst)[0] }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <x-app.quick-summary :data="$quickSummary" :class="'p-2'" />
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
