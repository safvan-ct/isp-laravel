@extends('layouts.web')

@section('title', ($chapter->book->translation?->name ?: $chapter->book->name) . ' | ' . ($chapter->translation?->name
    ?: $chapter->name))

@section('content')
    <main class="container my-3 flex-grow-1">
        <div class="index-card" style="padding: 5px">
            <div class="chapter-header mb-2">
                <div class="chapter-name">
                    {{ optional($chapter->translation)->name ? $chapter->translation->name . ' | ' : '' }}
                    <span class="notranslate">{{ $chapter->name }}</span>
                </div>
                <div class="notranslate">
                    {{ $chapter->book->translation?->name ?: $chapter->book->name }}
                </div>

                @if (!isset($verseNumber))
                    <div class="notranslate">
                        {{ __('app.chapter') }}: <strong class="ar-number">{{ $chapter->chapter_number }}</strong> |
                        {{ __('app.hadiths') }}: <strong class="ar-number">{{ $chapter->verses->count() }}</strong>
                    </div>
                @endif

                <div class="notranslate">
                    <a href="{{ route('hadith.chapters', $chapter->book->id) }}" id="book-url" style="color: #4E2D45;">
                        {{ __('app.chapters') }}
                    </a>

                    @if (isset($verseNumber))
                        | <a href="{{ route('hadith.chapter.verses', ['book' => $chapter->book->slug, 'chapter' => $chapter->id]) }}"
                            style="color: #4E2D45;">{{ $chapter->translation?->name ?: $chapter->name }}</a>
                    @endif
                </div>

                <div class="input-group mt-2 notranslate">
                    <input type="number" class="form-control" min="1" placeholder="Search hadith..."
                        id="hadith-number" value="{{ $verseNumber ?? '' }}" />
                    <button type="button" class="btn btn-primary" onclick="searchHadithByNumber()">
                        Go To
                    </button>
                </div>

                <div id="google_translate_element" class="mt-2 mb-0"></div>
            </div>

            @foreach ($chapter->verses as $hadith)
                <div class="ayah-card pb-0 item-card" data-id="{{ $hadith->id }}" data-type="hadith">
                    @if ($hadith->heading)
                        <div class="row flex-column flex-md-row">
                            <div class="col-12 col-md-6 order-1 order-md-2">
                                <h6 class="ayah-arabic notranslate fw-bold hadith-text fs-5 m-0" style="line-height: 1.6;">
                                    {{ $hadith->heading }}
                                </h6>
                            </div>

                            <div class="col-12 col-md-6 order-2 order-md-1">
                                <h6 class="fw-bold fs-6 hadith-tr-text">{{ $hadith->translation?->heading }}</h6>
                            </div>
                        </div>
                        <hr>
                    @endif

                    <div class="row flex-column flex-md-row">
                        <div class="col-12 col-md-6 order-1 order-md-2">
                            <div class="ayah-arabic notranslate hadith-text" style="font-size: 20px; line-height: 1.6;">
                                {{ $hadith->text }}
                                (<span class="fst-italic fs-6 ar-number">{{ $loop->iteration }}</span>)
                            </div>
                        </div>

                        <div class="col-12 col-md-6 order-2 order-md-1">
                            <div class="text-en hadith-tr-text">{{ $hadith->translation?->text }}</div>
                        </div>
                    </div>

                    <hr>
                    <p class="text-muted small notranslate fst-italic">
                        {{ $chapter->book->translation?->name ?: $chapter->book->name }},

                        {{ __('app.volume') }}: {{ $hadith->volume }},

                        {{ __('app.chapter') }}: #{{ $chapter->chapter_number }} -
                        {{ $chapter->translation?->name ?: $chapter->name }},

                        {{ __('app.hadith') }}: #{{ $hadith->hadith_number }},

                        {{ __('app.status') }}: {{ __('app.' . strtolower($hadith->status)) }}
                    </p>

                    <!-- Action Icons -->
                    <div class="d-flex align-items-center mt-1 gap-2">
                        <a href="javascript:void(0);" class="bookmark-btn text-decoration-none"
                            data-id="{{ $hadith->id }}" data-type="hadith" title="Bookmark">
                            <i class="far fa-bookmark"></i>
                        </a>

                        <a href="javascript:void(0);" class="like-btn text-decoration-none" data-id="{{ $hadith->id }}"
                            data-type="hadith" title="Like">
                            <i class="far fa-heart"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
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
        document.addEventListener("DOMContentLoaded", () => {
            updateAllLikeIcon('hadith');

            document.querySelectorAll('.ar-number').forEach(span => {
                const number = span.textContent.trim();
                span.textContent = toArabicNumber(number);
            });
        })

        function searchHadithByNumber() {
            const input = document.getElementById("hadith-number");
            const number = parseInt(input.value);

            if (isNaN(number) || number < 1) {
                alert("Please enter a valid Hadith number.");
                return;
            }

            window.location.href = "{{ route('hadith.book.verse', [$chapter->book->id, ':verse']) }}".replace(':verse',
                number);
        }

        function toArabicNumber(number) {
            const arabicDigits = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
            return String(number).split('').map(d => arabicDigits[d] || d).join('');
        }
    </script>
@endpush
