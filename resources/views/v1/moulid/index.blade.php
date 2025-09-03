@extends('layouts.app')

@push('styles')
@endpush

@section('content')
    @php
        $quickSummary = [];
        $chapters = [
            'മൗലിദ്: അർത്ഥവും തുടക്കവും',
            'ചരിത്രപരമായ വളർച്ച',
            'പ്രധാന മൗലിദ് ഗ്രന്ഥങ്ങൾ',
            'കേരളത്തിലെ മൗലിദ് പാരമ്പര്യം',
            'മങ്കൂസ് മൗലിദ് - കേരളത്തിലെ പ്രത്യേകത',
            'സംഗ്രഹം',
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
                    <li class="breadcrumb-item active" aria-current="page">മൗലിദ്</li>
                </ol>
            </nav>

            <hr class="mt-1 mb-3">

            <div class="text-center">
                <h5 class="fw-bold text-primary text-Playfair text-tr m-0">മൗലിദ് - <small>അനുബന്ധ വിഷയങ്ങൾ</small></h5>
                <p class="text-muted m-0">മൗലിദ് പാരമ്പര്യം - ചരിത്രവും പ്രധാന കൃതികളും</p>
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
                <aside class="col-md-3 col-12 d-flex flex-column gap-2 card-surface scroll"
                    style="cursor: pointer; max-height: 400px">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="text-primary fw-bold">{{ __('app.topics') }}</h6>
                        <p class="text-muted small m-0 fw-bold">Total: {{ count($chapters) }}</span></small>
                    </div>
                    <hr class="m-0">

                    @foreach ($chapters as $key => $item)
                        <div class="card rounded-0 shadow-sm {{ $key == 0 ? 'bg-success-subtle' : '' }}"
                            onclick="setTopic('{{ $item }}', {{ $key + 1 }}, this)">
                            <div class="d-flex align-items-center gap-2">
                                <h6 class="fw-bold m-0 text-primary">{{ $key + 1 }}. </h6>

                                <div>
                                    <h6 class="text-primary m-0">{{ $item }}</h6>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </aside>

                <section class="col-md-9 col-12">
                    <div class="card-surface">
                        <h5 class="fw-bold text-primary m-0 mb-2" id="topicTitle">1. മൗലിദ്: അർത്ഥവും തുടക്കവും</h5>

                        <span id="topicContent">
                            <p class="m-0 mb-2">
                                “മൗലിദ്” (مولد) എന്നത് അറബിയിൽ ജനനം എന്നാണ് അർത്ഥം. പ്രവാചകൻ മുഹമ്മദ് ﷺ ന്റെ ജനനം
                                സ്മരിക്കുകയും,
                                അദ്ദേഹത്തിന്റെ ജീവചരിത്രം, മഹത്വം, സലാത്ത്-സലാം, ഖുര്‍ആൻ പാരായണം
                                എന്നിവ അടങ്ങിയ ചടങ്ങാണ് മൗലിദ്.
                            </p>

                            <p class="m-0">
                                പ്രവാചകൻ ﷺ യുടെയും സഹാബികളുടെയും കാലത്ത് <strong>മൗലിദ് ആഘോഷമായി ഉണ്ടായിരുന്നില്ല.</strong>
                                ചരിത്രകാരന്മാർ പറഞ്ഞത് പ്രകാരം, ഇത് <strong>6-7-ാം ഹിജ്റി നൂറ്റാണ്ടിലാണ്</strong>
                                ആരംഭിച്ചത്.[1]
                            </p>
                        </span>

                        <div class="d-flex justify-content-end align-items-center">
                            <button type="button" class="btn btn-outline-secondary btn-sm mt-2 me-2" data-bs-toggle="modal"
                                data-bs-target="#quickSummaryModal">
                                References
                            </button>
                            <button type="button" class="btn btn-outline-success btn-sm mt-2" onclick="nextTopic(1)">
                                Next
                            </button>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </main>

    <button type="button" class="btn btn-warning rounded-pill position-fixed bottom-0 end-0 me-3 mb-5 z-3 d-none"
        id="backToTop">
        <i class="fas fa-arrow-up text-white"></i>
    </button>

    <div class="modal fade" id="quickSummaryModal" tabindex="-1" aria-labelledby="quickSummaryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header position-sticky top-0 z-3 bg-white">
                    <h5 class="modal-title" id="quickSummaryModalLabel">References</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="p-3">
                    <ol>
                        <li>Ibn Khaldun, Muqaddimah.</li>
                        <li>Ibn Dihya, al-Tanwir fi Mawlid al-Bashir al-Nadhir, 7th century AH.</li>
                        <li>Ibn Kathir, al-Bidaya wa’l-Nihaya, Vol. 13.</li>
                        <li>Al-Diba‘i, al-Mawlid al-Diba‘i, Yemen, 944 AH.</li>
                        <li>Al-Barzanji, ‘Iqd al-Jawahir, Madinah, 1177 AH.</li>
                        <li>Suyuti, Husn al-Maqsad fi Amal al-Mawlid.</li>
                        <li>Roland E. Miller, Mappila Muslims of Kerala, Oxford University Press, 1992.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function setTopic(topic, id, el) {
            $("#topicTitle").text(id + ". " + topic);
            $(el).addClass("bg-success-subtle");
            $(el).siblings().removeClass("bg-success-subtle");
            $('#topicContent').html('');

            if (id == 1) {
                $('#topicContent').html(`
                    <p class="m-0 mb-2">
                        “മൗലിദ്” (مولد) എന്നത് അറബിയിൽ ജനനം എന്നാണ് അർത്ഥം. പ്രവാചകൻ മുഹമ്മദ് ﷺ ന്റെ ജനനം
                        സ്മരിക്കുകയും,
                        അദ്ദേഹത്തിന്റെ ജീവചരിത്രം, മഹത്വം, സലാത്ത്-സലാം, ഖുര്‍ആൻ പാരായണം
                        എന്നിവ അടങ്ങിയ ചടങ്ങാണ് മൗലിദ്.
                    </p>

                    <p class="m-0">
                        പ്രവാചകൻ ﷺ യുടെയും സഹാബികളുടെയും കാലത്ത് <strong>മൗലിദ് ആഘോഷമായി ഉണ്ടായിരുന്നില്ല.</strong>
                        ചരിത്രകാരന്മാർ പറഞ്ഞത് പ്രകാരം, ഇത് <strong>6-7-ാം ഹിജ്റി നൂറ്റാണ്ടിലാണ്</strong>
                        ആരംഭിച്ചത്.[1]
                    </p>
                `);
            } else if (id == 2) {
                $('#topicContent').html(`
                    <ul>
                        <li><strong>ഇബ്ന്‍ ദഹ്‌യ അൽ-കല്ബി (d. 633 AH)</strong>: മൗലിദ് സംബന്ധിച്ച് ആദ്യകാലത്ത് എഴുതിയ പണ്ഡിതരിൽ ഒരാൾ.[2]</li>
                        <li><strong>മുജഫർ അൽ-കുക്ബുരി (IrbiL, Iraq)</strong>: 7-ാം നൂറ്റാണ്ടിൽ പൊതുയോഗങ്ങളായി മൗലിദ് ആഘോഷം സംഘടിപ്പിച്ചു.[3]</li>
                        <li><strong>ഫാതിമീ ഭരണാധികാരികൾ (മിസ്റ്):</strong> മൗലിദിനെ പൊതുപരിപാടിയായി നടപ്പാക്കി.</li>
                        <li><strong>പിന്നീട് യെമൻ, ഹദ്രാമൗത്ത്, ഹിജാസ്, മദീന, മിസ്റ്</strong> പ്രദേശങ്ങളിൽ നിന്നുള്ള സൂഫി-ഉലമാക്കളുടെ വഴിയാണ് ലോകത്തേക്ക് വ്യാപിച്ചത്.</li>
                    </ul>
                `);
            } else if (id == 3) {
                $('#topicContent').html(`
                    <p>മൗലിദ് ചടങ്ങുകളിൽ സാധാരണയായി പാരായണം ചെയ്യപ്പെടുന്ന ഗ്രന്ഥങ്ങൾ:</p>
                    <ol>
                        <li>
                            <strong>മൗലിദ് അദ്-ദിബാഈ (المولد الديبعي)</strong>
                            <ol type="a">
                                <li>രചയിതാവ്: അബ്ദുറഹ്‌മാൻ ബിൻ അലി അദ്-ദിബാഈ (944 AH, യെമൻ).</li>
                                <li>ഇന്നും വ്യാപകമായി വായിക്കപ്പെടുന്ന കൃതി.[4]</li>
                            </ol>
                        </li>
                        <li>
                            <strong>മൗലിദ് അൽ-ബറ്ജൻജി (المولد البرزنجي)</strong>
                            <ol type="a">
                                <li>രചയിതാവ്: ജാഫർ ബിൻ ഹസ്സൻ അൽ-ബറ്ജൻജി അൽ-മദനീ (1177 AH).</li>
                                <li>ശാഫിഈ മദ്ഹബിലെ പ്രമുഖ ഉലമ. കേരളത്തിലും ഏറെ പ്രചാരത്തിലുള്ള കൃതി.[5]</li>
                            </ol>
                        </li>
                        <li>
                            <strong>മൗലിദ് സിംതുദ്ദുറർ (سمط الدرر)</strong>
                            <ol type="a">
                                <li>രചയിതാവ്: ഇബ്ന്‍ ദഹ്‌യ അൽ-കല്ബി (633 AH).</li>
                                <li>ചരിത്രത്തിലെ ആദ്യകാലത്തെ മൗലിദ് പുസ്തകങ്ങളിൽ ഒന്നായി കണക്കാക്കപ്പെടുന്നു.[6]</li>
                            </ol>
                        </li>
                        <li>
                            <strong>മൗലിദ് അൽ-അമ്മീൻ (المولد الأمين)</strong>
                            <ol type="a">
                                <li>പ്രവാചകന്റെ പേരായ “അൽ-അമ്മീൻ” (വിശ്വസ്തൻ) അനുസരിച്ച് തയ്യാറാക്കിയ ഗ്രന്ഥം.</li>
                            </ol>
                        </li>
                        <li>
                            <strong>മൗലിദ് അൽ-അസ്ഹരീ (المولد الأزهري)</strong>
                            <ol type="a">
                                <li>അൽ-അസ്ഹർ പണ്ഡിതന്മാർ തയ്യാറാക്കിയ പതിപ്പുകൾ.</li>
                            </ol>
                        </li>
                    </ol>
                `);
            } else if (id == 4) {
                $('#topicContent').html(`
                    <ol>
                        <li>
                            <strong>അറബിക്കടൽ വ്യാപാരികളും ഹദ്രാമൗത്ത് (യെമൻ) സൂഫി പണ്ഡിതന്മാരും</strong> വഴിയാണ് മൗലിദ് കേരളത്തിലേക്ക് എത്തിയത്.[7]
                        </li>
                        <li>
                            <strong>മൗലിദ് മാല:</strong> മലയാള കവിതാരൂപത്തിലുള്ള പ്രവാചക സ്മരണാ കൃതികൾ, ഖാസിം മുസ്‌ലിയാർ, പാണക്കൽ ഉലമ മുതലായവർ രചിച്ചത്.
                        </li>
                        <li>
                            <strong>കേരളത്തിലെ ചടങ്ങുകൾ:</strong>
                            <ol type="a">
                                <li><strong>വീട്ടുമൗലിദ്</strong> - വീട്ടിലോ ചെറിയ സംഗമങ്ങളിലോ.</li>
                                <li><strong>മൗലിദ് മഹ്‌ഫിൽ</strong> - മസ്ജിദിലും വലിയ കൂട്ടായ്മകളിലും</li>
                                <li>മൗലിദ് മാല പാരായണം - മലയാളത്തിലുളള ജനകീയ രൂപം.</li>
                            </ol>
                        </li>
                    </ol>
                `);
            } else if (id == 5) {
                $('#topicContent').html(`
                    <p>കേരളത്തിലെ <strong>മൗലിദ് മഹ്‌ഫിലുകളിൽ</strong> ഏറെ വായിക്കപ്പെടുന്ന പ്രത്യേക പതിപ്പാണ് മങ്കൂസ് മൗലിദ് (منقوص مولد).</p>
                    <ol>
                        <li>
                            “മങ്കൂസ്” എന്നത് ചുരുക്കിയത് / കൊത്തിയെടുത്തത് എന്നർത്ഥം.
                        </li>
                        <li>
                            <strong>ദിബാഈ, ബറ്ജൻജി</strong> പോലുള്ള വലിയ അറബി മൗലിദുകളിൽ നിന്ന് പ്രധാന ഭാഗങ്ങൾ തിരഞ്ഞെടുത്ത് <strong>ചുരുക്കം</strong> രൂപത്തിൽ ഒരുക്കിയതാണ്.
                        </li>
                        <li>
                            സാധാരണ വീടുകളിലും ചെറിയ സംഗമങ്ങളിലും “മങ്കൂസ് മൗലിദ്” കൂടുതലായി ഉപയോഗിക്കുന്നു.
                        </li>
                    </ol>
                `);
            } else if (id == 6) {
                $('#topicContent').html(`
                    <ol>
                        <li>
                            <strong>മൗലിദ്</strong> - പ്രവാചകൻ ﷺ ന്റെ ജനനം സ്മരിക്കുന്ന ചടങ്ങ്.
                        </li>
                        <li>
                            <strong>ചരിത്രം</strong> - 6-7-ാം ഹിജ്റി നൂറ്റാണ്ടിൽ ആരംഭിച്ചു.
                        </li>
                        <li>
                            <strong>പ്രധാന കൃതികൾ</strong> - ദിബാഈ, ബറ്ജൻജി, സിംതുദ്ദുറർ, അമ്മീൻ, അസ്ഹരീ.
                        </li>
                        <li>
                            <strong>കേരളത്തിലെ കൃതികൾ</strong> - മങ്കൂസ് മൗലിദ്, മൗലിദ് മാല.
                        </li>
                        <li>
                            <strong>മതനിലപാട്</strong> - ചില ഉലമാക്കൾ അത് നബി ﷺ യുടെ മഹത്വം സ്മരിക്കുന്ന “ബിദ്അത്ത് ഹസന (നല്ല പുതിയ കാര്യം)” എന്ന് കാണുമ്പോൾ, ചില ഉലമാക്കൾ അത് ബിദ്അത്ത് (പുതിയ കാര്യം) എന്ന് നിരാകരിക്കുന്നു.
                        </li>
                        <li>
                            <strong>പാരമ്പര്യം</strong> - കേരളത്തിലെ ഒരു വിഭാഗം മുസ്ലിംകളുടെ മത-സാംസ്കാരിക ജീവിതത്തിൽ ഇന്നും കേന്ദ്രസ്ഥാനത്ത് തുടരുന്നു.
                        </li>
                    </ol>

                    <div class="card-surface bg-primary-subtle shadow-sm border-0 rounded-3">
                        <div class="d-flex align-items-center gap-3">
                            <i class="fas fa-info-circle fa-lg mt-1" style="color: #0d6efd"></i>
                            <p class="m-0">തീർച്ചയായും എനിക്ക് ശേഷം, നിങ്ങളിൽ ആരെങ്കിലും ജീവിച്ചാൽ, അവൻ ധാരാളം വ്യത്യാസം കാണും.
                                പുതുതായി കണ്ടുപിടിച്ച കാര്യങ്ങളെ സൂക്ഷിക്കുക, കാരണം അവ വഴിതെറ്റിയതാണ്. നിങ്ങളിൽ ആരെങ്കിലും
                                അത് കാണുന്നുവെങ്കിൽ, അവൻ എന്റെ സുന്നത്തും സന്മാർഗ്ഗം പ്രാപിച്ച ഖുലഫയുടെ സുന്നത്തും മുറുകെ
                                പിടിക്കണം, അണപ്പല്ലുകൾ കൊണ്ട് അത് മുറുകെ പിടിക്കണം.  — <em class="small">തിർമിധി: 2676</em>
                            </p>
                        </div>
                    </div>
                `);
            }
        }
    </script>
@endpush
