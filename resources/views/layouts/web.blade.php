<!DOCTYPE html>
<html lang="ml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ഇസ്ലാമിക് സ്റ്റഡി പോർട്ടൽ</title>

    <!-- Favicon for most browsers -->
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">

    <!-- Android Chrome -->
    <link rel="icon" type="image/png" sizes="192x192" href="assets/img/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="assets/img/android-chrome-512x512.png">

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Malayalam&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Amiri&family=Cairo&family=Noto+Naskh+Arabic&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('web/css/custom.css') }}">

    @stack('styles')
</head>

<body>
    <div class="loader" id="pageLoader">
        <div class="spinner"></div>
    </div>

    <nav class="navbar navbar-expand-lg sticky-top notranslate">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-semibold" href="{{ route('home') }}">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo">
                <div>
                    ISLAMIC<br>
                    <span class="d-block small">STUDY PORTAL</span>
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}"
                            href="{{ route('home') }}">HOME</a>
                    </li>
                    {{-- <li class="nav-item"><a class="nav-link" href="islam.html">ISLAM</a></li>
                    <li class="nav-item"><a class="nav-link" href="beliefs.html">BELIEF</a></li> --}}
                    <li class="nav-item">
                        <a class="nav-link {{ Str::is('quran.*', Route::currentRouteName()) ? 'active' : '' }}"
                            href="{{ route('quran.index') }}">QURAN</a>
                    </li>
                    {{-- <li class="nav-item"><a class="nav-link" href="hadith.html">HADITH</a></li>
                    <li class="nav-item"><a class="nav-link" href="life.html">LIFE OF MUSLIM</a></li> --}}

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

    <footer class="notranslate">
        © {{ date('Y') }} Islamic Life | All Rights Reserved |
        <a href="https://www.instagram.com/islamicstudyportal/" target="_blank" class="text-white">
            <i class="bi bi-instagram"></i>
        </a> |
        <a href="https://www.youtube.com/@islamic_study_portal" target="_blank" class="text-white">
            <i class="bi bi-youtube"></i>
        </a>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('web/js/custom.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", async () => {
            const loader = document.getElementById("pageLoader");
            if (loader) loader.style.display = "none";
        });
    </script>

    @stack('scripts')
</body>

</html>
