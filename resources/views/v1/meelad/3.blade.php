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
                                    <p class="small text-muted m-0 mb-2">
                                        (പ്രവാചകൻ ﷺ ജനിച്ച ദിവസം ആഘോഷിക്കൽ, പ്രത്യേക പാരായണങ്ങൾ നടത്തൽ)
                                        സംബന്ധിച്ച് <strong>ഖുർആനിൽ നേരിട്ടുള്ള പരാമർശമോ ഉത്തരവാദിത്വ നിർദ്ദേശമോ
                                            ഇല്ല.</strong>
                                    </p>
                                    <div class="small m-0">
                                        എന്നാൽ, ചില പണ്ഡിതന്മാർ താഴെക്കാണുന്ന ഖുർആൻ ആയത്തുകൾ ചൂണ്ടിക്കാണിച്ച് നബി ﷺയുടെ
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
                                    <p class="small text-muted m-0">
                                        മൗലിദ് / നബി ദിന ആഘോഷങ്ങൾ (പ്രവാചകൻ ﷺ ജനിച്ച ദിവസം ആഘോഷിക്കുന്നത്) സംബന്ധിച്ച്
                                        പ്രത്യേകമായും “മൗലിദ് ആഘോഷിക്കുക” എന്ന് പറയുന്ന സഹീഹ് ഹദീസ് ഒന്നും ഇല്ല.
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
                                        <strong>മൗലിദ് സംബന്ധിച്ച് നേരിട്ട് ഒന്നും പറഞ്ഞിട്ടില്ല, കാരണം അത് അവരുടെ കാലത്ത്
                                            ഇല്ലായിരുന്നു.</strong>
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <div class="card mb-3 mt-3 shadow-sm">
                        <h5 class="fw-bold text-primary">Quick summary</h5>

                        <p class="m-0 mb-2">
                            🔹 <strong>ഖുർആനിലോ, സഹീഹ് ഹദീസ് പ്രകാരമോ, ഖലീഫമാരും സ്വഹാബികളും മുഖേനയോ, നാല്
                                ഇമാമുമാർ (ഹനഫി, മാലികി, ശാഫിഈ, ഹൻബലി) മുഖേനയോ</strong> മൗലിദ് പാരായണം, മറ്റുള്ള ആഘോഷങ്ങൾ
                            സ്ഥിരമായിട്ടില്ല.
                        </p>

                        <p class="m-0 mb-1">
                            🔹 പിന്നീട് വന്നിട്ടുള്ള <strong>ചില പണ്ഡിതർ മൗലിദ് ശരീഅത്ത് വിരുദ്ധമായ (ഹറാം)
                                കാര്യങ്ങളില്ലാതെ</strong>, ഖുർആൻ, സലാത്ത്, ദുആ, നബി ചരിത്രം പഠിക്കൽ, ഭക്ഷണം വിതരണം
                            മുതലായവയ്ക്കായി നടത്തിയാൽ അത് <strong>ബിദ്അത് ഹസന (നല്ല പുതുമ)</strong> ആണെന്ന്
                            അഭിപ്രായപ്പെടുന്നു.
                        </p>

                        <p class="m-0 mb-1">
                            🔹 ചിലർ ഇത് <strong>ബിദ്അത് (പുതുമ) ആയതിനാൽ ഒഴിവാക്കണം</strong> എന്ന് അഭിപ്രായപ്പെടുന്നു.
                        </p>
                        <hr>

                        <ul class="check-list m-0">
                            <li class="fst-italic mb-1">
                                “നിനക്ക് അറിവില്ലാത്ത യാതൊരു കാര്യത്തിന്‍റെയും പിന്നാലെ നീ പോകരുത്‌.” — <em
                                    class="fw-bold">S. 17:36</em>
                            </li>
                            <li class="fst-italic mb-1">
                                “നമ്മുടെ മതത്തിന്റെ തത്വങ്ങൾക്ക് നിരക്കാത്ത എന്തെങ്കിലും ആരെങ്കിലും പുതുതായി ഉണ്ടാക്കിയാൽ
                                അത്
                                നിരസിക്കപ്പെടും.” — <em class="fw-bold">സഹീഹ് ബുഖാരി: 2697</em>
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

                    <div class="card-surface mb-3 bg-light">
                        <h6 class="fw-bold text-primary">ചരിത്രപരമായ ഉത്ഭവം</h6>
                        <article class="mt-3">
                            <ol class="m-0">
                                <li>
                                    <h6 class="fw-bold">ഇസ്ലാമിക കാലഘട്ടത്തിലെ ആദ്യകാലം</h6>
                                    <ol style="list-style-type: lower-alpha">
                                        <li>
                                            <p class="fst-italic m-0 text-muted">
                                                പ്രവാചകൻ ﷺ യുടെ സഹാബികൾ നേരിട്ട് മൗലിദ് ആഘോഷിച്ചിട്ടില്ല.
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
                                <li>
                                    <h6 class="fw-bold">ഇബ്‌നു മുബാറക് (170-279 ഹിജ്റ) കാലഘട്ടം</h6>
                                    <ol style="list-style-type: lower-alpha">
                                        <li>
                                            <p class="fst-italic m-0 text-muted">
                                                മൗലിദിനെ കുറിച്ച് ഒരു ചെറിയ പാരായണ ആചാരം ചില മുസ്ലിം സമൂഹങ്ങളിൽ രൂപപ്പെട്ടു.
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
                                <li>
                                    <h6 class="fw-bold">ഈജിപ്ത് – ഫാത്തിമി കാലഘട്ടം (390–600 ഹിജ്റ)</h6>
                                    <ol style="list-style-type: lower-alpha">
                                        <li>
                                            <p class="fst-italic m-0 text-muted">
                                                മൗലിദ് ആഘോഷത്തിന്റെ സമ്പൂർണ ആചാരം ഫാത്തിമി സുല്‍ത്താനുമാരുടെ ഭരണകാലത്ത്
                                                വ്യാപിച്ചു.
                                            </p>
                                        </li>
                                        <li>
                                            <p class="fst-italic m-0 text-muted">
                                                ഖുർആൻ പാരായണം, സലാത്ത്, നബി ﷺ ജനനകഥ, പൊതുഭക്ഷണം എന്നിവ ഈ സമയത്ത് പ്രധാന
                                                ഘടകങ്ങളായി.
                                            </p>
                                        </li>
                                    </ol>
                                </li>
                                <li>
                                    <h6 class="fw-bold">ഒടുവിൽ ഓട്ടോമൻ കാലഘട്ടം, അറബ് ലോകം, ഇന്ത്യ</h6>
                                    <ol style="list-style-type: lower-alpha">
                                        <li>
                                            <p class="fst-italic m-0 text-muted">
                                                മൗലിദ് വലിയ ആഘോഷമായി മസ്ജിദുകളിൽ, പ്രാദേശിക സ്ഥലങ്ങളിൽ വ്യാപിച്ചു.
                                            </p>
                                        </li>
                                        <li>
                                            <p class="fst-italic m-0 text-muted">
                                                ഇന്ത്യയിൽ (300 വർഷമായി) സൂഫി ശാഖകൾ മൗലിദ് ആഘോഷിക്കുന്നതിൽ മുന്നേറ്റം നടത്തി.
                                            </p>
                                        </li>
                                    </ol>
                                </li>
                            </ol>
                        </article>
                        <hr class="mb-4 d-none">
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
                    <h6 class="fw-bold text-primary">Quick reminder</h6>

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
                                ﴿ ذَاكَ يَوْمٌ وُلِدْتُ فِيهِ، وَيَوْمٌ بُعِثْتُ - أَوْ أُنْزِلَ عَلَيَّ فِيهِ ﴾
                            </h6>

                            <p class="fst-italic small m-0">
                                ഞാൻ ജനിച്ച ദിവസമായിരുന്നു അത് (തിങ്കളാഴ്ച). അന്ന് എനിക്ക് പ്രവാചകത്വം നൽകുകയോ എനിക്ക്
                                ദിവ്യബോധനം നൽകുകയോ
                                ചെയ്തു.
                            </p>

                            <p class="m-0 mt-1 text-muted small">സഹീഹ് മുസ്ലിം: 2747</p>
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
                    <p class="m-0 mb-2">
                        🔹 <strong>ഖുർആനിലോ, സഹീഹ് ഹദീസ് പ്രകാരമോ, ഖലീഫമാരും സ്വഹാബികളും മുഖേനയോ, നാല്
                            ഇമാമുമാർ (ഹനഫി, മാലികി, ശാഫിഈ, ഹൻബലി) മുഖേനയോ</strong> വഴി 12 എന്നത് സ്ഥിരമായിട്ടില്ല..
                    </p>

                    <p class="m-0 mb-1">
                        🔹 നബി ﷺ ജനിച്ച കൃത്യമായ തിയ്യതിയെക്കുറിച്ച് ചരിത്രകാരന്മാര്‍ക്കിടയില്‍ അഭിപ്രായവ്യത്യാസമുണ്ട്
                        (8, 9, 12 റ.അ. എന്നിവ പറയപ്പെടുന്നു).
                    </p>

                    <p class="m-0 mb-1">
                        🔹 എങ്കിലും, ചരിത്രകാരന്മാർക്കിടയിൽ 12 “പ്രധാന അഭിപ്രായം” ആയി മാറി.
                    </p>

                    <p class="m-0 mb-1">
                        🔹 അബ്ബാസി, ഫാത്തിമി കാലഘട്ടങ്ങളിൽ <strong>മൗലിദ് തുടങ്ങുമ്പോൾ, ജനങ്ങൾക്ക് “ഒരൊറ്റ തീയതി”
                            വേണമായിരുന്നു. അവർ 12 റ.അ. സ്വീകരിച്ചു</strong> → കാരണം അത് ഏറ്റവും പ്രചരിച്ചിരുന്ന
                        അഭിപ്രായം ആയിരുന്നു.
                    </p>
                    <p class="m-0 mb-1 fw-bold">
                        🔹 നബി ﷺ പറഞ്ഞത്: “ഞാന്‍ തിങ്കളാഴ്ച നോമ്പുവയ്ക്കുന്നത്, ആ ദിവസം തന്നെയാണ് ഞാന്‍ ജനിച്ചതും
                        എനിക്കു വെഹ്‌യി വന്നതും ആയതു കൊണ്ടാണ്.” (സഹീഹ് മുസ്ലിം: 2747)
                    </p>
                    <hr>

                    <div class="bg-danger-subtle rounded shadow-sm mb-3">
                        <h6 class="m-0 text-center fw-bold ls-2">
                            ആചാരമാക്കുന്നവര്‍ ശുദ്ധമായ തൗഹീദിലും സുന്നത്തിലുമുള്ള മാര്‍ഗ്ഗങ്ങളില്‍ നില്‍ക്കുക;
                            ചെയ്യാത്തവര്‍ക്കു നേരെ അപവാദമില്ല, ചെയ്യുന്നവര്‍ തെറ്റായ കൂട്ടി ചേർക്കലുകൾ ഒഴിവാക്കുക.
                        </h6>
                        <p class="m-0 fst-italic text-center">
                            പുതുതായി കണ്ടുപിടിച്ച കാര്യങ്ങളെ സൂക്ഷിക്കുക, കാരണം അവ വഴിതെറ്റിയതാണ്. നിങ്ങളിൽ ആരെങ്കിലും
                            അത്
                            കാണുന്നുവെങ്കിൽ, അവൻ എന്റെ സുന്നത്തും സന്മാർഗ്ഗം പ്രാപിച്ച ഖുലഫയുടെ സുന്നത്തും മുറുകെ
                            പിടിക്കണം.
                            <span class="small text-muted">- അൽ-തിർമിധി: 2676</span>
                        </p>
                    </div>

                    <ul class="check-list m-0">
                        <li class="fst-italic mb-1">
                            “നിനക്ക് അറിവില്ലാത്ത യാതൊരു കാര്യത്തിന്‍റെയും പിന്നാലെ നീ പോകരുത്‌.” — <em class="fw-bold">S.
                                17:36</em>
                        </li>
                        <li class="fst-italic mb-1">
                            “ഞാൻ ജനിച്ച ദിവസമായിരുന്നു അത് (തിങ്കളാഴ്ച). അന്ന് എനിക്ക് പ്രവാചകത്വം നൽകുകയോ എനിക്ക്
                            ദിവ്യബോധനം നൽകുകയോ ചെയ്തു.” — <em class="fw-bold">സഹീഹ് മുസ്ലിം: 2747</em>
                        </li>
                        <li class="fst-italic mb-1">
                            “നമ്മുടെ മതത്തിന്റെ തത്വങ്ങൾക്ക് നിരക്കാത്ത എന്തെങ്കിലും ആരെങ്കിലും പുതുതായി ഉണ്ടാക്കിയാൽ
                            അത്
                            നിരസിക്കപ്പെടും.” — <em class="fw-bold">സഹീഹ് ബുഖാരി: 2697</em>
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
