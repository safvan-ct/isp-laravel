@extends('layouts.web')

@section('title', __('Hadith') . ' | ' . ($book->translation?->name ?: $book->name))

@section('content')
    <main class="container my-3 flex-grow-1">
        <div class="index-card">
            <div class="chapter-header mb-3">
                <div class="chapter-name">
                    {{ optional($book->translation)->name ? $book->translation->name . ' | ' : '' }}{{ $book->name }}
                </div>
                <div class="notranslate">
                    {{ $book->translation?->writer ?: $book->writer }}
                </div>

                <div class="input-group">
                    <input type="number" class="form-control" min="1" placeholder="Search hadith..."
                        id="hadith-number" />
                    <button type="button" class="btn btn-primary" onclick="searchHadithByNumber()">
                        Go To
                    </button>
                </div>
            </div>

            <ul class="index-list col-two">
                @foreach ($book->chapters as $item)
                    <a href="{{ route('hadith.chapter.verses', ['book' => $book->slug, 'chapter' => $item->id]) }}"
                        class="text-decoration-none">
                        <li class="mb-2">
                            {{ $loop->iteration }}. {{ $item->translation?->name ?: $item->name }}
                            <i class="bi bi-play-fill"></i>
                        </li>
                    </a>
                @endforeach
            </ul>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        function searchHadithByNumber() {
            const input = document.getElementById("hadith-number");
            const number = parseInt(input.value);

            if (isNaN(number) || number < 1) {
                alert("Please enter a valid Hadith number.");
                return;
            }

            window.location.href = "{{ route('hadith.book.verse', [$book->id, ':verse']) }}".replace(
                ':verse', number);
        }
    </script>
@endpush
