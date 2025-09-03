@extends('layouts.app')

@push('styles')
    <style>
        /* Timeline line */
        .timeline {
            position: relative;
            padding: 2rem 0;
        }

        .timeline::before {
            content: "";
            position: absolute;
            top: 0;
            bottom: 0;
            left: 50%;
            width: 4px;
            background: #dee2e6;
            transform: translateX(-50%);
        }

        /* Timeline item */
        .timeline-item {
            position: relative;
            margin-bottom: 2rem;
        }

        .timeline-item .timeline-icon {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 40px;
            background: #0d6efd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            z-index: 1;
        }

        .timeline-item .timeline-content {
            width: 45%;
            padding: 1rem;
            border-radius: .5rem;
            background: #f8f9fa;
            position: relative;
        }

        .timeline-item-left .timeline-content {
            margin-right: auto;
            text-align: right;
        }

        .timeline-item-right .timeline-content {
            margin-left: auto;
            text-align: left;
        }

        @media (max-width: 768px) {
            .timeline::before {
                left: 20px;
            }

            .timeline-item .timeline-icon {
                left: 20px;
                transform: none;
            }

            .timeline-item .timeline-content {
                width: calc(100% - 60px);
                margin-left: 60px !important;
                text-align: left !important;
            }
        }
    </style>
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
                    കാലഘട്ടങ്ങളും നബിദിന ആഘോഷങ്ങളുടെ ആരംഭവും.
                </p>
            </div>
        </header>

        <div class="timeline mt-3">
            <!-- Item 1 -->
            <div class="timeline-item timeline-item-left">
                <div class="timeline-icon">
                    <i class="bi bi-flag"></i>
                </div>
                <div class="timeline-content shadow-sm">
                    <h5 class="fw-bold">ആദ്യകാലം (H0 - H300)</h5>
                    <ul class="diamond-list m-0">
                        <li class="mb-1">
                            നബി (ﷺ) കാലത്തും, സഹാബിമാർ കാലത്തും, <strong>നബിദിനം പ്രത്യേകമായി ആഘോഷിച്ചിരുന്നില്ല.</strong>
                        </li>
                        <li class="mb-1">
                            നബി (ﷺ) തിങ്കളാഴ്ച നോമ്പ് എടുത്തു. കാരണം: “ഞാൻ ഈ ദിവസമാണ് ജനിച്ചത്” (<em
                                class="small text-muted">മുസ്ലിം: 2747</em>).
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Item 2 -->
            <div class="timeline-item timeline-item-right">
                <div class="timeline-icon bg-success">
                    <i class="bi bi-lightbulb"></i>
                </div>
                <div class="timeline-content shadow-sm">
                    <h5 class="fw-bold">അബ്ബാസി കാലം (H300 - H500)</h5>
                    <ul class="diamond-list m-0">
                        <li class="mb-1">
                            അബ്ബാസി ഖിലാഫത്ത് (ബാഗ്ദാദ്) കാലത്ത്, ചിലർ <strong>നബിദിനം ഓർക്കാൻ പ്രത്യേക സംഗമങ്ങൾ
                                നടത്തി.</strong>
                        </li>
                        <li class="mb-1">
                            ഖുർആൻ വായന, ദുആ, കവിതകൾ (നബി ﷺ യെ പുകഴ്ത്തുന്ന മദ്ഹ് കവിതകൾ).
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Item 3 -->
            <div class="timeline-item timeline-item-left">
                <div class="timeline-icon bg-warning">
                    <i class="bi bi-code-slash"></i>
                </div>
                <div class="timeline-content shadow-sm">
                    <h5 class="fw-bold">ഫാത്തിമി കാലം (H500 - H600)</h5>
                    <ul class="diamond-list m-0">
                        <li class="mb-1">
                            ഈജിപ്തിലെ ഫാത്തിമി ഭരണാധികാരികൾ ആദ്യം <strong>പൊതുവേദിയിൽ നബിദിനം നടത്തി.</strong>
                        </li>
                        <li class="mb-1">
                            പരിപാടികൾ: ഖുർആൻ പാരായണം, പ്രസംഗം, ഭക്ഷണം വിതരണം, ദരിദ്രരെ സഹായിക്കൽ.
                        </li>
                    </ul>
                    <p class="mb-0 text-muted">
                        👉 അതിനാൽ, “നബിദിനം പൊതുഉത്സവം” ആദ്യമായി ഇവിടെ കണ്ടു.
                    </p>
                </div>
            </div>

            <!-- Item 4 -->
            <div class="timeline-item timeline-item-right">
                <div class="timeline-icon bg-info">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="timeline-content shadow-sm">
                    <h5 class="fw-bold">എർബിൽ (ഇറാഖ്) - H600 - H700</h5>
                    <ul class="diamond-list m-0">
                        <li class="mb-1">
                            1207-ൽ (H600-ൽക്കാലത്ത്), മുസാഫർ അൽദീൻ ഗോക്ക്‌ബുരി (ഒരു മുസ്ലിം ഭരണാധികാരി) <strong>എർബിലി-ൽ
                                വലിയ
                                നബിദിനം നടത്തി.</strong>
                        </li>
                        <li class="mb-1">ലക്ഷക്കണക്കിന് ആളുകൾ, ഭക്ഷണം, കവിത, പ്രസംഗം.</li>
                    </ul>
                    <p class="mb-0 text-muted">
                        👉 ആദ്യത്തെ വലിയ ഔദ്യോഗിക പൊതുആഘോഷം ആയി കണക്കാക്കുന്നു.
                    </p>
                </div>
            </div>

            <div class="timeline-item timeline-item-left">
                <div class="timeline-icon bg-secondary">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="timeline-content shadow-sm">
                    <h5 class="fw-bold">ഒട്ടോമാൻ സാമ്രാജ്യം (H900 - H1000)</h5>
                    <ul class="diamond-list m-0">
                        <li class="mb-1">
                            ടർക്കിയിലെ ഒട്ടോമാൻ ഭരണാധികാരികൾ (Ottoman Empire) 1588-ൽ <strong>മീലാദിനെ സർക്കാർ അവധിദിനമായി
                                പ്രഖ്യാപിച്ചു.</strong>
                        </li>
                        <li class="mb-1">“Mevlid Kandil” എന്ന് വിളിച്ചു.</li>
                    </ul>
                    <p class="mb-0 text-muted">
                        👉 പിന്നീട്, എല്ലാ നാട്ടിലും നബിദിനം വലിയ ഉത്സവമായി മാറി.
                    </p>
                </div>
            </div>

            <div class="timeline-item timeline-item-right">
                <div class="timeline-icon bg-dark">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="timeline-content shadow-sm">
                    <h5 class="fw-bold">H1000 - ഇന്ന് വരെ</h5>
                    <ul class="diamond-list m-0">
                        <li class="mb-1">
                            ഇന്ത്യ, പാകിസ്ഥാൻ, ടർക്കി, ആഫ്രിക്ക, മലേഷ്യ, ഇന്തോനേഷ്യ തുടങ്ങി <strong>ലോകം മുഴുവൻ നബിദിനം
                                ആഘോഷം
                                വ്യാപിച്ചു.</strong>
                        </li>
                        <li class="mb-1">
                            പരിപാടികൾ: ഖുർആൻ പാരായണം, മൗലിദ് കവിത, പൊതുഭക്ഷണം, ദരിദ്രരെ സഹായിക്കൽ, പ്രഭാഷണങ്ങൾ
                        </li>
                    </ul>
                    <p class="mb-0 text-muted">
                        👉 ചില പണ്ഡിതർ ഇത് ബിദ്അത് ഹസന (നല്ല പുതുമ) ആണെന്ന് അഭിപ്രായപ്പെടുന്നു.<br>
                        👉 ചിലർ ഇത് ബിദ്അത് (പുതുമ) ആയതിനാൽ ഒഴിവാക്കണം എന്ന് അഭിപ്രായപ്പെടുന്നു.
                    </p>
                </div>
            </div>

            <div class="timeline-item timeline-item-left">
                <div class="timeline-icon bg-danger">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="timeline-content shadow-sm bg-danger-subtle">
                    <h5 class="fw-bold">🕋 മക്ക</h5>
                    <ul class="diamond-list m-0">
                        <li class="mb-1">
                            <strong>ആദ്യം (H0 - H300):</strong> പ്രത്യേക നബിദിന <strong>ആഘോഷം ഉണ്ടായിരുന്നില്ല.</strong>
                        </li>
                        <li class="mb-1">
                            <strong>പിന്നീട് (H900 - H1200 കാലത്ത്):</strong> മക്കയിലെ ചില ഭരണാധികാരികൾ (മുഗൾ, മമ്ലൂക് കാലം)
                            <strong>പൊതു ആഘോഷം നടത്തി.</strong>
                        </li>
                        <li class="mb-1">
                            <strong>1924-ൽ (1342H)</strong> സൗദി ഭരണാധികാരം വന്നതോടെ, നബിദിനം ബിദ്അത് എന്ന് പറഞ്ഞ്
                            <strong>പൊതു ആഘോഷം നിരോധിച്ചു.</strong>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="timeline-item timeline-item-right">
                <div class="timeline-icon bg-danger">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="timeline-content shadow-sm bg-danger-subtle">
                    <h5 class="fw-bold">🌙 മദീന</h5>
                    <ul class="diamond-list m-0">
                        <li class="mb-1">
                            <strong>ആദ്യം (H0 - H500): ആഘോഷം ഇല്ല.</strong>
                        </li>
                        <li class="mb-1">
                            <strong>H600 - H700:</strong> ഫാത്തിമി സ്വാധീനവും എർബിൽ ആഘോഷവും കഴിഞ്ഞ്, മദീനയിലും ചില
                            <strong>ചെറിയ സംഗമങ്ങൾ തുടങ്ങി.</strong>
                        </li>
                        <li class="mb-1">
                            <strong>ഒട്ടോമാൻ കാലത്ത് (H1000 - H1300):</strong> മദീനയിൽ <strong>പൊതുവേദികളിലും മസ്ജിദ്
                                പരിസരത്തും ആഘോഷം നടന്നു.</strong>
                        </li>
                        <li class="mb-1">
                            <strong>1924-ൽ (1342H)</strong> സൗദി ഭരണാധികാരം വന്നതോടെ, നബിദിനം ബിദ്അത് എന്ന് പറഞ്ഞ്
                            <strong>പൊതു ആഘോഷം നിരോധിച്ചു.</strong>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="timeline-item timeline-item-left">
                <div class="timeline-icon bg-success">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="timeline-content shadow-sm bg-success-subtle">
                    <h5 class="fw-bold">🕌 ഫലസ്തീൻ (ഖുദ്സ്)</h5>
                    <ul class="diamond-list m-0">
                        <li class="mb-1">
                            <strong>ആദ്യം (H0 - H500): ആഘോഷം ഇല്ല.</strong>
                        </li>
                        <li class="mb-1">
                            <strong>അയ്യൂബി ഭരണാധികാരി സലാഹുദ്ദീൻ (H583)</strong> ജറുസലേം വീണ്ടെടുത്തപ്പോൾ
                            <strong>പൊതുആഘോഷമായി നടത്തി.</strong>
                        </li>
                        <li class="mb-1">
                            <strong>മുസാഫർ അൽദീൻ ഗോക്ക്‌ബുരി (എർബിൽ ഭരണാധികാരി) (H604) → ഏറ്റവും വലിയ മൗലിദ് ആഘോഷം
                                നടത്തി.</strong>
                        </li>
                        <li class="mb-1">
                            <strong>ഒട്ടോമാൻ കാലത്ത് (H900 - H1000):</strong> ഫലസ്തീൻ മുഴുവനും സർക്കാർ പിന്തുണയോടെ
                            <strong>മൗലിദ്
                                വലിയ ഉത്സവമായി.</strong>
                        </li>
                        <li class="mb-1">
                            <strong>1967 (1387H)</strong> - ഇപ്പോഴും തുടരുന്നു മത-സാംസ്കാരിക-രാഷ്ട്രീയ ഐക്യത്തിന്റെ ദിനം.
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <x-app.share :title="array_keys($qst)[0]" />
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
                <div class="modal-header position-sticky top-0 z-3 bg-white">
                    <h5 class="modal-title text-primary" id="quickSummaryModalLabel">{{ array_keys($qst)[0] }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <x-app.quick-summary :data="$quickSummary" :class="'rounded-0'" />
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
