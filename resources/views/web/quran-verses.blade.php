@extends('layouts.web')

@section('title', 'ഖുർആൻ പഠനം | ' . ($chapter->translation?->name ?: $chapter->name))

@section('content')
    <main class="container my-3">
        <div class="index-card">
            <div class="chapter-header mb-3">
                <div class="chapter-name">
                    {{ optional($chapter->translation)->name ? $chapter->translation->name . ' | ' : '' }}{{ $chapter->name }}
                </div>

                <div>
                    Chapter: <strong class="ar-number">{{ $chapter->id }}</strong> |
                    Ayahs: <strong class="ar-number">{{ $chapter->no_of_verses }}</strong>
                </div>
            </div>

            @foreach ($chapter->verses as $item)
                <div class="ayah-card">
                    <div class="ayah-arabic">
                        <span class="quran-text">{{ $item->text }}</span>
                        <span class="ayah-number ar-number">{{ $item->number_in_chapter }}</span>
                    </div>

                    @if ($item->translation)
                        <div class="ayah-trans">{{ $item->translation->text }}</div>
                    @endif
                </div>
            @endforeach
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        function toArabicNumber(number) {
            const arabicDigits = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
            return String(number).split('').map(d => arabicDigits[d] || d).join('');
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.ar-number').forEach(span => {
                const number = span.textContent.trim();
                span.textContent = toArabicNumber(number);
            });
        });
    </script>
@endpush
