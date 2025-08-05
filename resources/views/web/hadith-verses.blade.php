@extends('layouts.web')

@section('title', ($chapter->book->translation?->name ?: $chapter->book->name) . ' | ' . ($chapter->translation?->name
    ?: $chapter->name))

@section('content')
    <main class="container my-3 flex-grow-1">
        <div class="index-card">
            <div class="chapter-header mb-3">
                <div class="chapter-name">
                    {{ optional($chapter->translation)->name ? $chapter->translation->name . ' | ' : '' }}
                    <span class="notranslate">{{ $chapter->name }}</span>
                </div>
                <div class="notranslate">
                    {{ $chapter->book->translation?->name ?: $chapter->book->name }}
                </div>

                @if (!isset($verseNumber))
                    <div class="notranslate">
                        {{ __('Chapter') }}: <strong class="ar-number">{{ $chapter->chapter_number }}</strong> |
                        {{ __('Hadiths') }}: <strong class="ar-number">{{ $chapter->verses->count() }}</strong>
                    </div>
                @endif

                <div class="notranslate">
                    <a href="{{ route('hadith.chapters', $chapter->book->id) }}" id="book-url"
                        style="color: #4E2D45;">{{ __('Chapters') }}</a>

                    @if (isset($verseNumber))
                        | <a href="{{ route('hadith.chapter.verses', [$chapter->id]) }}"
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

            @foreach ($chapter->verses as $index => $hadith)
                <div class="ayah-card">
                    @if ($hadith->heading)
                        <h6 class="ayah-arabic notranslate fw-bold hadith-text fs-5 m-0" style="line-height: 1.6">
                            {{ $hadith->heading }}
                        </h6>
                        <h6 class="fw-bold fs-6">{{ $hadith->translation?->heading }}</h6>
                    @endif

                    <div class="ayah-arabic notranslate hadith-text" style="font-size: 20px; line-height: 1.6">
                        {{ $hadith->text }}
                        (<span class="fst-italic fs-6 ar-number">{{ $loop->iteration }}</span>)
                    </div>

                    <div class="text-en">{{ $hadith->translation?->text }}</div>

                    <p class="text-muted small notranslate mt-1 fst-italic">
                        {{ $chapter->book->translation?->name ?: $chapter->book->name }},

                        Volume: {{ $hadith->volume }},

                        {{ __('Chapter') }}: #{{ $hadith->chapter->chapter_number }} -
                        {{ $chapter->translation?->name ?: $chapter->name }},

                        {{ __('Hadith') }}: #{{ $hadith->hadith_number }},

                        Status: {{ $hadith->status }}
                    </p>
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
