<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', __('app.islamic_study_portal'))</title>

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
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&family=Amiri:wght@400;700&display=swap"
        rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Malayalam&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link href="{{ asset('web/v2/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('web/v2/css/custom.css') }}" rel="stylesheet">
    @stack('styles')
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg fixed-top" aria-label="Main navigation">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
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
                            href="{{ route('calendar') }}">{{ __('app.calendar') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Str::is('modules.*', $routeName) ? 'active' : '' }} text-uppercase"
                            href="{{ route('modules.show', 'life-of-muslim') }}">Topics</a>
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
                                href="{{ route('likes') }}">
                                {{ __('app.likes') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ Str::is('login', $routeName) || Str::is('register', $routeName) ? 'active' : '' }} text-uppercase"
                                href="{{ route('login') }}">
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
    <footer class="mt-3">
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

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="{{ asset('web/v2/js/custom.js') }}"></script>

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
