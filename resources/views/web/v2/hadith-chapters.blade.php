@extends('layouts.web-v2')

@section('content')
    <main class="container">
        <x-app.page-hero>
            <div class="text-center mb-2">
                <h4 class="text-primary fw-bold text-Playfair text-ml">{{ $book->translation?->name ?? $book->name }} — Chapters</h4>
                <p class='small text-muted m-0'>
                    {{ $book->translation?->writer ?? $book->writer }} ({{ $book->writer_death_year }}H)
                </p>
                <p class="small text-muted m-0">
                    Hadiths. {{ $book->hadith_count }} • Chapters. {{ $book->chapter_count }}
                </p>
            </div>
        </x-app.page-hero>

        <div class="row my-3 g-2">
            @php
                $chapter = $book->chapters->where('id', $verses->first()->hadith_chapter_id)->first();
            @endphp

            <aside class="col-md-4 col-12 card-surface scroll" style="cursor: pointer">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class=" text-primary fw-bold">Chapters</h6>
                    <p class="text-muted small m-0 fw-bold">Total: <span>{{ $book->chapters->count() }}</span></small>
                </div>

                @foreach ($book->chapters as $item)
                    <div class="card {{ $chapter->id == $item->id ? 'active' : '' }} mb-2"
                        data-url="{{ route('hadith.chapters', ['book' => $book->id, 'chapter' => $item->id]) }}"
                        onclick="window.location.href = this.dataset.url">
                        <div class="d-flex align-items-center gap-2">
                            <h6 class="fw-bold m-0 text-primary">{{ $item->chapter_number }}. </h6>

                            <div>
                                <h5 class="text-primary m-0 text-hadith" style="direction: ltr">{{ $item->name }}</h5>
                                <p class="text-muted small m-0">{{ $item->translation?->name ?? $item->name }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </aside>

            <!-- RIGHT: chapter detail + hadiths -->
            <section class="col-md-8 col-12">
                <div class="card-surface d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="fw-bold text-primary m-0">
                            {{ $chapter->chapter_number }}. {{ $chapter->translation?->name ?? $chapter->name }}
                        </h6>
                        <p class="text-muted small m-0">{{ $chapter->verses->count() }} hadiths</p>
                    </div>

                    <h5 class="m-0 text-hadith">{{ $chapter->name }}</h5>
                </div>

                <!-- hadith list -->
                <div class="mt-2">
                    @foreach ($verses as $item)
                        <article class="card-surface d-flex align-items-start mb-2">
                            <div class="flex-grow-1">
                                <h4 class="text-primary lh-base text-hadith text-justify">
                                    {{ $item->text }}
                                    <span class="fs-6 text-muted">({{ $verses->firstItem() + $loop->index }})</span>
                                </h4>

                                <p class="m-0 text-justify">{{ $item->translation?->text }}</p>

                                <div class="d-flex align-items-center gap-1 mt-2">
                                    <span class="text-muted">Hadith: {{ $item->hadith_number }}</span>
                                    <span>•</span>
                                    <span class="text-muted">Volume: {{ $item->volume }}</span>
                                    <span>•</span>
                                    <span class="badge bg-success rounded-pill">{{ $item->status }}</span>
                                </div>

                                <div class="d-flex align-items-center justify-content-end gap-1">
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
                    {{ $verses->onEachSide(1)->links() }}
                </div>
            </section>
        </div>
    </main>
@endsection
