@extends('layouts.app')

@section('content')
    @php
        $quickSummary = [
            'title' => 'നബി ദിനം ആഘോഷിക്കുന്നത് പ്രവാചക ചര്യ (സുന്നത്ത്) അല്ല.',
            'notes' => [
                '<strong>പ്രവാചകൻ ﷺ</strong> തന്റെ ജന്മദിനം <strong>ആഘോഷിച്ചിട്ടില്ല</strong>.',
                '<strong>സഹാബികളും ഖലീഫാക്കളും</strong> (അബൂബക്കർ, ഉമർ, ഉസ്മാൻ, അലി) <strong>ആഘോഷിച്ചിട്ടില്ല</strong>.',
                '<strong>ഖുർആൻ</strong>–ൽ അതിനൊരു നിർദ്ദേശമില്ല.',
                '<strong>ഹദീസ്</strong>: പ്രവാചകൻ ﷺ തിങ്കളാഴ്ച നോമ്പ് നോൽക്കാറുണ്ടായിരുന്നു (സഹീഹ് മുസ്ലിം: 2747).',
                '<strong>മദ്ഹബുകളുടെ ഇമാമുമാർ</strong>: അവരുടെ കാലത്ത് ഇതിനെ പ്രത്യേക ആരാധനയായികാണിച്ചിട്ടില്ല.',
            ],
            'true' => 'പ്രവാചക ചര്യ തിങ്കളാഴ്ച നോമ്പാണ്, ജന്മദിനാഘോഷമല്ല.',
            'good' =>
                'നബി ദിനം ആഘോഷിക്കാത്തത് ഇസ്‌ലാമിക വിരോധമല്ല. മറിച്ച് പ്രവാചകന്റെയും സഹാബികളുടെയും ശരിയായ മാർഗമാണ്.',
            'bad' =>
                'പ്രതേക വിരുന്ന്, ഗാനങ്ങൾ, ചടങ്ങുകൾ, മൗലിദ് സദസ്സ്, ലൈറ്റുകൾ, കൂട്ടം ചേർന്ന് ആഘോഷിക്കൽ ചര്യയല്ല ബിദ്അത് ആണ്.',
            'trust' => [
                'നിനക്ക് അറിവില്ലാത്ത യാതൊരു കാര്യത്തിന്‍റെയും പിന്നാലെ നീ പോകരുത്‌. — <em class="text-muted small">S. 17:36</em>',
                'ഞാൻ ജനിച്ച ദിവസമായിരുന്നു അത് (തിങ്കളാഴ്ച). — <em class="text-muted small">സഹീഹ് മുസ്ലിം: 2747</em>',
                'മതത്തിന്റെ തത്വങ്ങൾക്ക് നിരക്കാത്ത എന്തെങ്കിലും പുതുതായി ഉണ്ടാക്കിയാൽ അത് നിരസിക്കപ്പെടും. — <em class="text-muted small">സഹീഹ് ബുഖാരി: 2697</em>',
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
                <div class="modal-header mb-2 position-sticky top-0 z-3 bg-white">
                    <h5 class="modal-title text-primary" id="quickSummaryModalLabel">{{ array_keys($qst)[0] }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <x-app.quick-summary :data="$quickSummary" :class="'p-1'" />
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
