@extends('layouts.app')

@section('content')
    @php
        $quickSummary = [
            'title' => 'നബി ദിനം ആഘോഷിക്കുന്നത് പ്രവാചക ചര്യ (സുന്നത്ത്) അല്ല.',
            'notes' => [
                '<strong>പ്രവാചകൻ ﷺ</strong> തന്റെ ജന്മദിനം <strong>ആഘോഷിച്ചിട്ടില്ല</strong>.',
                '<strong>സഹാബികളും ഖലീഫാക്കളും</strong> (അബൂബക്കർ, ഉമർ, ഉസ്മാൻ, അലി) <strong>ആഘോഷിച്ചിട്ടില്ല</strong>.',
                '<strong>ഖുർആൻ</strong>–ൽ അതിനൊരു നിർദ്ദേശമില്ല.',
                '<strong>ഹദീസ്</strong>: പ്രവാചകൻ ﷺ തിങ്കളാഴ്ച നോമ്പ് നോൽക്കാറുണ്ടായിരുന്നു - <em class="text-muted small"> മുസ്ലിം: 2747.</em>',
                '<strong>മദ്ഹബുകളുടെ ഇമാമുമാർ</strong>: അവരുടെ കാലത്ത് ഇതിനെ പ്രത്യേക ആരാധനയായികാണിച്ചിട്ടില്ല.',
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

        <div class="row g-2 my-1">
            <section class="col-lg-8">
                <article class="card-surface">
                    <x-app.topic-header :title="array_keys($qst)[0]" />

                    <hr class="mt-2 mb-3">

                    <x-app.quick-summary :data="$quickSummary" />
                </article>
            </section>

            <!-- SIDEBAR -->
            <aside class="col-lg-4 position-sticky d-flex flex-column align-self-start gap-2" style="top:84px;">
                <div class="card-surface">
                    <h6 class="fw-bold text-primary mb-3">Trust & reminder</h6>

                    <div class="text-center mx-auto mb-2">
                        <x-app.ayah-card :translation="'ഇന്ന് ഞാന്‍ നിങ്ങള്‍ക്ക് നിങ്ങളുടെ മതം പൂര്‍ത്തിയാക്കി തന്നിരിക്കുന്നു. മതമായി ഇസ്ലാമിനെ ഞാന്‍ നിങ്ങള്‍ക്ക് തൃപ്തിപ്പെട്ട് തന്നിരിക്കുന്നു.'" :number="'S. 5:3'" />
                    </div>

                    <div class="text-center mx-auto mb-2">
                        <x-app.ayah-card :translation="'നിനക്ക് അറിവില്ലാത്ത യാതൊരു കാര്യത്തിന്‍റെയും പിന്നാലെ നീ പോകരുത്‌.'" :number="'S. 17:36'" />
                    </div>

                    <div class="text-center mx-auto mb-2">
                        <x-app.ayah-card :translation="'(തിങ്കളാഴ്ച നോമ്പിനെ കുറിച് ചോദിക്കപ്പെട്ടപ്പോൾ): ഞാൻ ജനിച്ച ദിവസമായിരുന്നു അത്. അന്ന് എനിക്ക് പ്രവാചകത്വം നൽകുകയോ എനിക്ക് ദിവ്യബോധനം നൽകുകയോ ചെയ്തു.'" :number="'മുസ്ലിം: 2747'" />
                    </div>

                    <div class="text-center mx-auto mb-2">
                        <x-app.ayah-card :translation="'പുതുതായി കണ്ടുപിടിച്ച കാര്യങ്ങളെ സൂക്ഷിക്കുക, അവ വഴിതെറ്റിയതാണ്. നിങ്ങളിൽ ആരെങ്കിലും അത് കാണുന്നുവെങ്കിൽ, അവൻ എന്റെ സുന്നത്തും സന്മാർഗ്ഗം പ്രാപിച്ച ഖുലഫയുടെ സുന്നത്തും മുറുകെ പിടിക്കണം.'" :number="'തിർമിധി: 2676'" />
                    </div>

                    <div class="text-center mx-auto">
                        <x-app.ayah-card :translation="'ക്രിസ്ത്യാനികൾ മർയമിന്റെ മകനെ പുകഴ്ത്തിയതുപോലെ എന്നെ പുകഴ്ത്തുന്നതിൽ നിങ്ങൾ അതിശയോക്തി കാണിക്കരുത്, കാരണം ഞാൻ ഒരു അടിമ മാത്രമാണ്. അതിനാൽ എന്നെ അല്ലാഹുവിന്റെ അടിമയെന്നും അവന്റെ ദൂതനെന്നും വിളിക്കൂ.'" :number="'ബുഖാരി: 3445'" />
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
                    <h5 class="modal-title text-primary" id="quickSummaryModalLabel">{{ array_keys($qst)[0] }}</h5>
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
