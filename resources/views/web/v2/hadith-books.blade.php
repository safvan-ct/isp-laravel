@extends('layouts.web-v2')

@section('content')
    <main class="container">
        <x-app.page-hero>
            <div class="text-center mb-2">
                <h4 class="text-primary fw-bold text-Playfair">Hadith Collections</h4>
                <p class="small text-muted m-0">
                    Canonical hadith books — authors, scope, and sample narrations. Search, filter, and open any book for
                    details.
                </p>
            </div>

            <div class=" mb-0 row justify-content-center">
                <div class="col-md">
                    <input class="form-control form-control-sm rounded-pill"
                        placeholder="Search by book name, author, or keyword…" />
                </div>

                <div class="col-auto">
                    <select class="form-select form-select-sm rounded-pill align-items-center">
                        <option value="recommended">Recommended</option>
                        <option value="count-desc">Most hadiths</option>
                        <option value="count-asc">Fewest hadiths</option>
                        <option value="era">Author era</option>
                    </select>
                </div>
            </div>
        </x-app.page-hero>

        <div class="row g-2 my-2">
            @foreach ($books as $item)
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="card d-flex flex-column h-100 justify-content-between">
                        <div class="d-flex align-items-center mb-1">
                            <div class="icon-card me-3">HB</div>

                            <div class="flex-1">
                                <h6 class="text-primary fw-bold m-0">{{ $item->translation?->name ?: $item->name }}</h6>
                                <p class="small text-muted m-0">{{ $item->translation?->writer ?: $item->writer }}
                                    ({{ $item->writer_death_year }}H)
                                </p>
                            </div>
                        </div>

                        <p class="small text-muted mb-2">
                            Hadiths: <strong>{{ $item->hadith_count }}</strong> •
                            Chapters: <strong>{{ $item->chapter_count }}</strong>
                        </p>

                        <div class="d-flex justify-content-end gap-2">
                            <button class="btn btn-sm btn-outline-success btn-open" onclick="openBook({{ $item->id }})">
                                Details
                            </button>
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('hadith.chapters', [$item->id]) }}">
                                Open
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <!-- BOOK DETAIL MODAL -->
    <div class="modal fade" id="bookModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content" style="border-radius:12px;">
                <div class="modal-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h3 id="modalTitle" class="mb-0"></h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="book-detail-head">
                        <div class="book-cover" id="modalCover">Book</div>
                        <div>
                            <div id="modalAuthor" class="fw-semibold"></div>
                            <div id="modalEra" class="muted small"></div>
                            <div id="modalType" class="chip mt-2"></div>
                            <div id="modalCount" class="book-sub mt-2"></div>
                            <div class="mt-3" id="modalDesc"></div>
                            <div class="mt-3">
                                <a id="modalOpen" class="btn btn-emerald btn-sm text-white me-2" href="#"
                                    target="_blank">Open Book</a>
                                <button id="modalBrowse" class="btn btn-outline-success btn-sm">Browse chapters</button>
                                <button id="modalBookmark" class="btn btn-outline-warning btn-sm">Bookmark</button>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-lg-7">
                            <h6 class="mb-2">Top chapters / sections</h6>
                            <div id="modalChapters" class="chapter-list mb-3"></div>

                            <h6 class="mb-2">Sample hadiths</h6>
                            <div id="modalSamples"></div>
                        </div>

                        <div class="col-lg-5">
                            <h6 class="mb-2">Why this book matters</h6>
                            <div id="modalWhy" class="muted small mb-3"></div>

                            <h6 class="mb-2">Quick filters</h6>
                            <div class="d-flex gap-2 flex-wrap mb-3">
                                <button class="btn btn-outline-secondary btn-sm chip" id="filterSahih">Show sahih
                                    narrations</button>
                                <button class="btn btn-outline-secondary btn-sm chip" id="filterTopic">Filter by
                                    topic</button>
                                <button class="btn btn-outline-secondary btn-sm chip" id="filterNarrator">Filter by
                                    narrator</button>
                            </div>

                            <h6 class="mb-2">External resource</h6>
                            <div class="small muted">You can open the full collection on Sunnah.com for canonical
                                numbering and full text.</div>
                        </div>
                    </div>
                </div> <!-- modal-body -->
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function openBook(id) {
            // model view
            $('#bookModal').modal('show');
        }
    </script>
@endpush
