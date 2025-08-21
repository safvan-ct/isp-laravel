@extends('layouts.web-v2')

@section('content')
    <main class="container">
        <header class="page-hero">
            <h3 class="text-title fw-semibold">{{ $book->translation?->name ?? $book->name }} — Chapters</h3>
            <p class='small-note m-0 mb-1'>
                {{ $book->translation?->writer ?? $book->writer }} ({{ $book->writer_death_year }}H)
            </p>
            <p class="small-note m-0">
                Hadiths. {{ $book->hadith_count }} • Chapters. {{ $book->chapter_count }}
            </p>
        </header>

        <div class="layout">
            @php
                $chapter = $book->chapters->where('id', $verses->first()->hadith_chapter_id)->first();
            @endphp
            <!-- LEFT: chapters -->
            <aside class="chapters" aria-label="Chapters">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <strong>Chapters</strong>
                    <small class="muted">Total: <span id="chapCount">{{ $book->chapters->count() }}</span></small>
                </div>

                <span>
                    @foreach ($book->chapters as $item)
                        <div class="chapter-item {{ $chapter->id == $item->id ? 'active' : '' }} mb-2"
                            data-url="{{ route('hadith.chapters', ['book' => $book->id, 'chapter' => $item->id]) }}"
                            onclick="window.location.href = this.dataset.url">

                            <div class="fw-bold">{{ $item->chapter_number }}. </div>

                            <div>
                                <h5 class="text-primary m-0 text-hadith">{{ $item->name }}</h5>
                                <p class="muted small m-0">{{ $item->translation?->name ?? $item->name }}</p>
                            </div>
                        </div>
                    @endforeach
                </span>
            </aside>

            <!-- RIGHT: chapter detail + hadiths -->
            <section class="content">
                <div class="chapter-hero mb-1">
                    <div class="fw-bold">
                        {{ $chapter->chapter_number }}. {{ $chapter->translation?->name ?? $chapter->name }}
                    </div>
                    <div class="muted small">{{ $chapter->verses->count() }} hadiths</div>
                    <h5 class="mt-1 mb-0 text-hadith">{{ $chapter->name }}</h5>
                </div>

                <!-- hadith list -->
                <div id="hadithList" class="mt-3" aria-live="polite">
                    @foreach ($verses as $item)
                        <article class="hadith-card d-flex align-items-start">
                            <div class="flex-grow-1">
                                <div class="hadith-ar text-hadith">
                                    {{ $item->text }}
                                    <span class="hadith-number-inline">{{ $verses->firstItem() + $loop->index }}</span>
                                </div>

                                <div class="hadith-tr">{{ $item->translation?->text }}</div>

                                <div class="hadith-meta">
                                    <span class="muted">Hadith: {{ $item->hadith_number }}</span>
                                    <span>•</span>
                                    <span class="muted">Volume: {{ $item->volume }}</span>
                                    <span>•</span>
                                    <span class="grade">{{ $item->status }}</span>
                                </div>

                                <div class="actions">
                                    <button class="btn btn-sm btn-outline-warning bookmark-btn" title="Bookmark Ayah"
                                        data-id="{{ $item->id }}" data-type="quran">
                                        <i class="far fa-star"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger like-btn" title="Like Ayah"
                                        data-id="{{ $item->id }}" data-type="quran">
                                        <i class="far fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- paginator -->
                <div class="d-flex justify-content-center">
                    {{ $verses->links() }}
                </div>
            </section>
        </div>
    </main>
@endsection
