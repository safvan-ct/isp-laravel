<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title class="notranslate">@yield('title', __('app.islamic_study_portal'))</title>

    <!-- Favicon for most browsers -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}">
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">

    <!-- Android Chrome -->
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('img/android-chrome-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('img/android-chrome-512x512.png') }}">

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" href="{{ asset('img/apple-touch-icon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&family=Amiri:wght@400;700&family=Lateef&family=Scheherazade+New:wght@400;700&family=Tajawal:wght@400;500;700&family=Cairo:wght@400;600;700&family=Markazi+Text:wght@400;600;700&family=Noto+Naskh+Arabic:wght@400;700&family=Noto+Kufi+Arabic:wght@400;700&display=swap&family=Noto+Sans+Malayalam&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link href="{{ asset('v1/css/custom.css') }}" rel="stylesheet">

    @if (App::getLocale() == 'ml')
        <link href="{{ asset('v1/css/style-ml.css') }}" rel="stylesheet">
    @endif

    <style>
        .check-list,
        .diamond-list {
            list-style: none;
            padding: 0;
        }

        .check-list li,
        .diamond-list li {
            position: relative;
            padding-left: 25px;
        }

        .check-list li::before {
            content: "✔";
            position: absolute;
            left: 0;
            color: green;
            font-weight: bold;
        }

        .diamond-list li::before {
            content: "🔹";
            position: absolute;
            left: 0;
            color: green;
            font-weight: bold;
        }

        .skiptranslate iframe {
            display: none !important;
        }

        body {
            top: 0px !important;
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg fixed-top notranslate" aria-label="Main navigation">
        <div class="container">
            <a class="navbar-brand text-Playfair" href="{{ route('home') }}">
                Islamic<span style="color:var(--clr-accent)"> Study Portal</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMain"
                aria-controls="navMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navMain" class="collapse navbar-collapse">
                @php
                    $routeName = Route::currentRouteName();
                    $menu_slug = isset($menuSlug) ? $menuSlug : null;
                    $menus = isset($menus) ? $menus : [];
                @endphp

                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                    <li class="nav-item">
                        <a class="nav-link {{ $routeName == 'home' ? 'active' : '' }} text-uppercase"
                            href="{{ route('home') }}">{{ __('app.home') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Str::is('quran.*', $routeName) ? 'active' : '' }} text-uppercase"
                            href="{{ route('quran.index') }}">{{ __('app.quran') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Str::is('hadith.*', $routeName) ? 'active' : '' }} text-uppercase"
                            href="{{ route('hadith.index') }}">{{ __('app.hadith') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Str::is('calendar', $routeName) ? 'active' : '' }} text-uppercase"
                            href="javascript:void(0)">{{ __('app.calendar') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Str::is('modules.*', $routeName) || Str::is('questions.*', $routeName) || Str::is('answers.*', $routeName) ? 'active' : '' }} text-uppercase"
                            href="{{ route('modules.show', 'life-of-muslim') }}">{{ __('app.topics') }}</a>
                    </li>

                    @if (Auth::check() && Auth::user()->role == 'Customer')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-uppercase {{ Str::is('collections.*', $routeName) || Str::is('likes', $routeName) ? 'active' : '' }}"
                                href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                {{ __('app.profile') }}
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                                <li>
                                    <a class="dropdown-item text-uppercase" href="#">{{ __('app.account') }}</a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-uppercase" href="{{ route('likes') }}">
                                        {{ __('app.likes') }}
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-uppercase" href="{{ route('collections.index') }}">
                                        {{ __('app.bookmarks') }}
                                    </a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <a href="javascript:void(0);" class="dropdown-item text-uppercase"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('app.logout') }}
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li>
                            <a class="nav-link {{ Str::is('likes', $routeName) ? 'active' : '' }} text-uppercase"
                                href="javascript:void(0)">
                                {{ __('app.likes') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ Str::is('login', $routeName) || Str::is('register', $routeName) ? 'active' : '' }} text-uppercase"
                                href="javascript:void(0)">
                                {{ __('app.login') }}
                            </a>
                        </li>
                    @endif

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-uppercase" href="#" id="languageDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ app()->getLocale() }}
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                            @foreach (array_keys(config('app.languages')) as $code)
                                <li>
                                    <a class="dropdown-item text-uppercase"
                                        href="{{ route('change.language', $code) }}">
                                        {{ $code }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- FOOTER -->
    <footer class="mt-3 notranslate">
        <div class="container py-3">
            <div class="row gy-3 align-items-center">
                <div class="col-md-6">
                    <div class="small text-light">
                        © <span>{{ date('Y') }}</span> Islamic Study Portal. All rights reserved.
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="small link-light me-3 text-decoration-none">About</a>
                    <a href="#" class="small link-light me-3 text-decoration-none">Contact</a>
                    <a href="#" class="small link-light text-decoration-none">Privacy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Quran & Hadith References -->
    <div class="modal fade" id="quranHadithModal" tabindex="-1" aria-labelledby="quranHadithModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header position-sticky top-0 z-3 bg-white">
                    <h5 class="modal-title" id="quranHadithModalLabel">നബിദിനം - {{ __('app.quran') }} &
                        {{ __('app.hadith') }} References</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="ayah-card rounded-0">
                    <h6 class="fw-bold text-primary mb-2">{{ __('app.quran') }}</h6>

                    <p class="m-0 small">
                        നിനക്ക് അറിവില്ലാത്ത യാതൊരു കാര്യത്തിന്‍റെയും പിന്നാലെ നീ പോകരുത്‌. — <em
                            class="small text-muted">S. 17:36</em>
                    </p>
                    <hr class="m-0 my-2">

                    <p class="m-0 small">
                        ഇന്ന് ഞാന്‍ നിങ്ങള്‍ക്ക് നിങ്ങളുടെ മതം പൂര്‍ത്തിയാക്കി തന്നിരിക്കുന്നു. എന്‍റെ അനുഗ്രഹം
                        നിങ്ങള്‍ക്ക് ഞാന്‍ നിറവേറ്റിത്തരികയും ചെയ്തിരിക്കുന്നു. മതമായി ഇസ്ലാമിനെ ഞാന്‍ നിങ്ങള്‍ക്ക്
                        തൃപ്തിപ്പെട്ട് തന്നിരിക്കുന്നു. — <em class="small text-muted">S. 5:3</em>
                    </p>
                </div>

                <div class="geo-divider my-2"></div>

                <div class="card-surface bg-light rounded-0">
                    <h6 class="fw-bold text-primary mb-2">{{ __('app.hadith') }}</h6>

                    <article class="mb-2">
                        <p class="small mb-1">
                            (തിങ്കളാഴ്ച നോമ്പിനെ കുറിച് ചോദിക്കപ്പെട്ടപ്പോൾ): ഞാൻ ജനിച്ച ദിവസമായിരുന്നു അത്. അന്ന്
                            എനിക്ക് പ്രവാചകത്വം നൽകുകയോ എനിക്ക് ദിവ്യബോധനം നൽകുകയോ ചെയ്തു.
                        </p>

                        <p class="small mb-0 text-muted">
                            Grade: <strong>Sahih</strong> • സഹീഹ് മുസ്ലിം: <strong>2747</strong>
                        </p>
                    </article>
                    <hr class="m-0 my-2">

                    <article class="mb-2">
                        <p class="small mb-1">
                            ക്രിസ്ത്യാനികൾ മർയമിന്റെ മകനെ പുകഴ്ത്തിയതുപോലെ എന്നെ പുകഴ്ത്തുന്നതിൽ നിങ്ങൾ അതിശയോക്തി
                            കാണിക്കരുത്, കാരണം ഞാൻ ഒരു അടിമ മാത്രമാണ്. അതിനാൽ എന്നെ അല്ലാഹുവിന്റെ അടിമയെന്നും അവന്റെ
                            ദൂതനെന്നും വിളിക്കൂ
                        </p>

                        <p class="small mb-0 text-muted">
                            Grade: <strong>Sahih</strong> • സഹീഹ് ബുഖാരി: <strong>3445</strong>
                        </p>
                    </article>
                    <hr class="m-0 my-2">

                    <article class="bt-2">
                        <p class="small mb-1">
                            നമ്മുടെ മതത്തിന്റെ തത്വങ്ങൾക്ക് നിരക്കാത്ത എന്തെങ്കിലും ആരെങ്കിലും പുതുതായി ഉണ്ടാക്കിയാൽ
                            അത് നിരസിക്കപ്പെടും.
                        </p>

                        <p class="small mb-0 text-muted">
                            Grade: <strong>Sahih</strong> • സഹീഹ് ബുഖാരി: <strong>2697</strong>
                        </p>
                    </article>
                    <hr class="m-0 my-2">

                    <article class="mb-2">
                        <p class="small text-muted mb-1">
                            നമ്മുടെ സമ്മതമില്ലാത്ത ഏതൊരു പ്രവൃത്തിയും ആരെങ്കിലും ചെയ്താൽ അത് നിരസിക്കപ്പെടും.
                        </p>

                        <p class="small mb-0 text-muted">
                            Grade: <strong>Sahih</strong> • സഹീഹ് മുസ്ലിം: <strong>4493</strong>
                        </p>
                    </article>
                    <hr class="m-0 my-2">

                    <article class="mb-2">
                        <p class="small mb-1">
                            എനിക്ക് ശേഷം ജീവിക്കുന്ന നിങ്ങളിൽ വലിയ അഭിപ്രായവ്യത്യാസങ്ങൾ കാണും. അപ്പോൾ നിങ്ങൾ
                            എന്റെയും സന്മാർഗ്ഗം പ്രാപിച്ച ഖലീഫമാരുടെയും സുന്നത്ത് പിന്തുടരണം. അത് മുറുകെ
                            പിടിക്കുകയും അതിൽ ഉറച്ചുനിൽക്കുകയും ചെയ്യുക. പുതുമകൾ ഒഴിവാക്കുക, കാരണം എല്ലാ പുതുമകളും
                            ഒരു പുതുമയാണ്, എല്ലാ പുതുമകളും ഒരു തെറ്റാണ്.
                        </p>

                        <p class="small mb-0 text-muted">
                            Grade: <strong>Sahih</strong> • സുനാൻ അബു ദാവൂദ്: <strong>4607</strong>
                        </p>
                    </article>
                    <hr class="m-0 my-2">

                    <article class="">
                        <p class="small mb-1">
                            തീർച്ചയായും, നിങ്ങളിൽ ആരെങ്കിലും ജീവിച്ചാൽ, അവൻ ധാരാളം വ്യത്യാസം കാണും. പുതുതായി
                            കണ്ടുപിടിച്ച കാര്യങ്ങളെ സൂക്ഷിക്കുക, കാരണം അവ വഴിതെറ്റിയതാണ്. നിങ്ങളിൽ ആരെങ്കിലും അത്
                            കാണുന്നുവെങ്കിൽ, അവൻ എന്റെ സുന്നത്തും സന്മാർഗ്ഗം പ്രാപിച്ച ഖുലഫയുടെ സുന്നത്തും മുറുകെ
                            പിടിക്കണം, അണപ്പല്ലുകൾ കൊണ്ട് അത് മുറുകെ പിടിക്കണം.
                        </p>

                        <p class="small mb-0 text-muted">
                            Grade: <strong>Sahih</strong> • ജാമി അൽ-തിർമിധി: <strong>2676</strong>
                        </p>
                    </article>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="{{ asset('v1/js/custom.js') }}"></script>

    <script>
        $(document).ready(function() {
            const $fabBtn = $('#filterFab');
            const $fabIcon = $fabBtn.find('i');
            const $filterContent = $('#filterContent');

            $filterContent.on('show.bs.collapse', function() {
                $fabIcon.removeClass('fa-filter').addClass('fa-times'); // or fa-xmark in FA6+
            });

            $filterContent.on('hide.bs.collapse', function() {
                $fabIcon.removeClass('fa-times').addClass('fa-filter');
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
