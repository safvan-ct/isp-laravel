@extends('layouts.web')

@section('title', $question->translation?->title ?: $question->slug)

@section('content')
    <header class="text-white text-center py-3 notranslate">
        <div class="container">
            <h3>{{ $question->translation?->title ?: $question->slug }}</h3>
            <p>{!! $question->translation?->sub_title !!}</p>

            <nav aria-label="breadcrumb" class="custom-breadcrumb rounded p-2 mt-1">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-decoration-none">{{ __('Home') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('questions.show', ['menu_slug' => $menuSlug, 'module_slug' => $moduleSlug]) }}"
                            class="text-decoration-none">
                            {{ $question->parent->translation?->title ?: $question->parent->slug }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-muted" aria-current="page">
                        {{ $question->translation?->title ?: $question->slug }}
                    </li>
                </ol>
            </nav>
        </div>
    </header>

    <main class="container my-3 flex-grow-1 notranslate">
        @foreach ($question->children as $item)
            <div class="mb-2 section-card">
                <h2>{{ $item->translation?->title ?: $item->slug }}</h2>

                @if ($item->translation?->content)
                    <p class="mb-0">{!! $item->translation?->content !!}</p>
                @endif

                @foreach ($item->quranVerses as $quranVerse)
                    @php
                        $verse = $quranVerse->quran;
                        $chapter = $quranVerse->quran->chapter;
                        $json = is_array($quranVerse->translation_json)
                            ? $quranVerse->translation_json
                            : json_decode($quranVerse->translation_json, true);
                    @endphp

                    <blockquote class="m-0 mt-1 notranslate"
                        onclick="openAddOnModal('quran', {{ $quranVerse->quran_verse_id }})" style="cursor: pointer;">
                        <p dir="rtl" class="quran-text">{{ $quranVerse->simplified }}</p>

                        {{ $json['ml'] }}

                        <br>
                        <span class="text-muted small fst-italic">
                            🔖 {{ $chapter->id }}.{{ $chapter->translation?->name ?: $chapter->name }}:
                            {{ $quranVerse->quran->number_in_chapter }}
                        </span>
                    </blockquote>
                @endforeach

                @foreach ($item->hadithVerses as $hadithVerse)
                    @php
                        $book = $hadithVerse->hadith->chapter->book;
                        $json = is_array($hadithVerse->translation_json)
                            ? $hadithVerse->translation_json
                            : json_decode($hadithVerse->translation_json, true);
                    @endphp

                    <blockquote class="m-0 mt-1 notranslate"
                        onclick="openAddOnModal('hadith', {{ $hadithVerse->hadith_verse_id }})" style="cursor: pointer;">
                        <p dir="rtl" class="quran-text">{{ $hadithVerse->simplified }}</p>

                        {{ $json['ml'] }}

                        <br><span class="text-muted small fst-italic">
                            🔖 {{ $book->translation?->name ?: $book->name }}: {{ $hadithVerse->hadith->hadith_number }}
                        </span>
                    </blockquote>
                @endforeach

                @if ($item->videos->isNotEmpty())
                    <div class="d-flex flex-wrap justify-content-center gap-2 mt-3">
                        @foreach ($item->videos as $video)
                            @php
                                $json = json_decode($video->title, true);
                                $title = empty($json['ml'])
                                    ? ($question->translation?->title ?:
                                    $question->slug)
                                    : $json['ml'];
                            @endphp

                            <button class="btn btn-outline-primary"
                                onclick="openAddOnModal('video', '{{ $video->video_id }}', '{{ $title }}')">
                                🎥 {{ $title }}
                                {{-- {{ __('View Video') }} --}}
                            </button>
                        @endforeach
                    </div>
                @endif
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

    <!-- Add-on Modal -->
    <div class="modal fade" id="addOnModal" tabindex="-1" aria-labelledby="addOnModalLabel">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title notranslate" id="addOnModalLabel"></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div id="google_translate_element" class="mt-2 mb-2 text-center d-none"></div>

                <div class="modal-body p-0" id="addOnModalBody">
                    <div class="text-center text-muted">{{ __('Loading Data') }}...</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                    pageLanguage: 'en',
                    includedLanguages: 'ml,hi',
                    layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                    autoDisplay: false
                },
                'google_translate_element'
            );
        }
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>

    <script>
        function openAddOnModal(type, id, title = '') {
            const modalElement = document.getElementById("addOnModal");
            const modalLabel = document.getElementById("addOnModalLabel");
            const modalBody = document.getElementById("addOnModalBody");
            modalBody.removeAttribute("style");

            let addOnModalLabel = '';
            let url = '';
            document.getElementById("google_translate_element").classList.add("d-none");

            if (type === 'quran') {
                addOnModalLabel = "📖 {{ __('Quran Revelation') }}";
                url = "{{ route('fetch.quran.verse', ':id') }}".replace(':id', id);
            } else if (type === 'hadith') {
                addOnModalLabel = "📜 {{ __('Hadith Details') }}";
                url = "{{ route('fetch.hadith.verse', ':id') }}".replace(':id', id);
                document.getElementById("google_translate_element").classList.remove("d-none");
            } else if (type === 'video') {
                addOnModalLabel = `🎥 ${title}`;
            } else {
                return;
            }

            modalLabel.innerHTML = addOnModalLabel;
            modalBody.innerHTML = `<div class="text-center text-muted py-3">{{ __('Loading Data') }}...</div>`;

            const modal = bootstrap.Modal.getOrCreateInstance(modalElement);
            modal.show();

            if (type === 'quran' || type === 'hadith') {
                fetch(url)
                    .then(res => res.json())
                    .then(result => {
                        if (!result) {
                            modalBody.innerHTML =
                                `<div class="text-danger text-center py-3">{{ __('No data found. Please try another.') }}</div>`;
                            return;
                        }

                        let arHeading = type === 'hadith' ? result.heading : '';
                        let trHeading = type === 'hadith' ? result.translations?.[0]?.heading || "" : '';
                        let arVerse = result.text;
                        let trVerse = result.translations?.[0]?.text || '<em>No translation available</em>';
                        let verseNumber = type === 'quran' ? result.number_in_chapter : result.hadith_number;

                        let reference = type === 'hadith' ? `${result.book.translations?.[0]?.name || result.book.name},
                                {{ __('Volume') }}: ${result.volume},
                                {{ __('Chapter') }}: #${result.chapter.chapter_number} - ${result.chapter.translations?.[0]?.name || result.chapter.name},
                                {{ __('Hadith') }}: #${result.hadith_number},
                                {{ __('Status') }}: ${result.status || 'Unknown'}` :
                            `${result.quran_chapter_id}.${result.chapter.translations?.[0]?.name || result.chapter.name}: ${verseNumber}`;

                        modalBody.innerHTML = `
                            <blockquote class="border-start m-0 ${type === 'quran' ? 'notranslate' : ''}">
                                ${arHeading ? `<p class="notranslate fw-bold m-0 fs-5" dir="rtl">${arHeading}</p> <p class="fw-bold mb-2">${trHeading}</p>` : ""}

                                <p dir="rtl" class="notranslate">
                                    <span class="fs-5 ${type === 'hadith' ? 'mt-1' : 'mt-3 quran-text'}" ${type === 'quran' ? 'style="line-height: 2.2;"' : ''}>
                                        ${arVerse}
                                    </span>
                                    <span class="ayah-number" ${type === 'hadith' ? 'style="font-size: 12px;"' : ''}>
                                        ${toArabicNumber(verseNumber)}
                                    </span>
                                </p>

                                <p class="mt-2">${trVerse}</p>

                                <p class="text-muted small fst-italic mt-2 notranslate">🔖 ${reference}</p>
                            </blockquote>
                        `;
                    })
                    .catch(err => {
                        modalBody.innerHTML =
                            `<div class="text-danger text-center py-3">{{ __('Informations not found') }}</div>`;
                    });

                return;
            } else {
                modalBody.setAttribute("style", "margin: -1px;");
                modalBody.innerHTML = `
                    <div class="ratio ratio-16x9">
                        <iframe id="videoIframe" src="https://www.youtube.com/embed/${id}?autoplay=1&mute=0&&modestbranding=1&rel=0" title="Video player" allowfullscreen allow="autoplay"></iframe>
                    </div>
                `;

                modalElement.addEventListener("hidden.bs.modal", () => {
                    document.getElementById("videoIframe").src = "";
                }, {
                    once: true
                });
            }
        }
    </script>
@endpush
