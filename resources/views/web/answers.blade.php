@extends('layouts.web')

@section('title', $question->translation?->title ?: $question->slug)

@section('content')
    <header class="text-white text-center py-3">
        <div class="container">
            <h3>{{ $question->translation?->title ?: $question->slug }}</h3>
            <p>{!! $question->translation?->sub_title !!}</p>

            <nav aria-label="breadcrumb" class="custom-breadcrumb rounded p-2 mt-1">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-decoration-none">{{ __('Home') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('questions', $question->parent->id) }}" class="text-decoration-none">
                            {{ $question->parent->translation?->title ?: $question->slug }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-muted" aria-current="page">
                        {{ $question->translation?->title ?: $question->slug }}
                    </li>
                </ol>
            </nav>
        </div>
    </header>

    <main class="container my-3 flex-grow-1">
        @foreach ($question->children as $item)
            <div class="mb-2 section-card">
                <h2>{{ $item->translation?->title ?: $item->slug }}</h2>

                @if ($item->translation?->content)
                    <p class="mb-0">{!! $item->translation?->content !!}</p>
                @endif

                {{--
                if (quran.length) {
                quran.forEach(({ ar = "", text = "", reference = "", sura = "", ayah = "" }) => {
                html += `
                <blockquote class="m-0 mt-1" onclick="viewQuran(${sura}, ${ayah})" style="cursor: pointer;">
                    ${ar ? `<p dir="rtl" class="quran-text">${ar}</p>` : ""}
                    ${text}
                    ${reference ? `<br><span class="text-muted small fst-italic">🔖 ${reference}</span>` : ""}
                </blockquote>`;
                });
                }

                if (hadiths.length) {
                hadiths.forEach(({ ar = "", text = "", reference = "", book_slug = "", hadith_number = "" }) =>
                {
                html += `
                <blockquote class="mb-0 mt-1" onclick="viewHadith('${book_slug}', ${hadith_number})"
                    style="cursor: pointer;">
                    ${ar ? `<p dir="rtl" class="quran-text">${ar}</p>` : ""}
                    ${text}
                    ${reference ? `<br><span class="text-muted small fst-italic">🔖 ${reference}</span>` : ""}
                </blockquote>`;
                });
                }

                if (video) {
                html += `<div class="mt-3 text-center">
                    <button class="btn btn-outline-primary" onclick="openVideo('${video}', '${title}')">
                        🎥 വീഡിയോ കാണുക
                    </button>
                </div>`;
                } --}}
            </div>
        @endforeach

        <div class="text-center" id="shareBox">
            <div class="p-4 rounded-4 shadow-sm share-box">
                <h4 class="fw-bold mb-3">📤 {{ __('Please share this information on to others.') }}</h4>
                <p class="mb-4">
                    {{ __('Prayer and goodness can continue even after death. Your contribution can remind someone else.') }}
                </p>
                <a href="javascript:void(0)" onclick="handleShare()" class="btn btn-primary rounded-pill px-4">
                    🔗 {{ __('Share It') }}
                </a>
            </div>
        </div>
    </main>

    <!-- Quran Modal -->
    <div class="modal fade notranslate" id="quranModal" tabindex="-1" aria-labelledby="quranModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title notranslate" id="quranModalLabel">📖 {{ __('Quran Revelation') }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body" id="quranModalBody">
                    <div class="text-center text-muted notranslate">{{ __('Loading Data') }}...</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hadith Modal -->
    <div class="modal fade" id="hadithModal" tabindex="-1" aria-labelledby="hadithModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title notranslate" id="hadithModalLabel">📜 {{ __('Hadith Details') }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div id="google_translate_element" class="mt-2 text-center mb-2"></div>

                <div class="modal-body pt-0" id="hadithModalBody">
                    <div class="text-center text-muted notranslate">{{ __('Loading Data') }}...</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Video Modal -->
    <div class="modal fade notranslate" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-black">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="videoModalLabel"></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="ratio ratio-16x9">
                        <iframe id="videoIframe" src="" title="Video video player" allowfullscreen
                            allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
