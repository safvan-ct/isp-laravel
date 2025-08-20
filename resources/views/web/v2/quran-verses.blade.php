@extends('layouts.web-v2')

@section('content')
    <main class="container pb-5">
        <!-- HERO -->
        <header class="page-hero" aria-live="polite">
            <div class="mx-auto">
                <div class="chapter-number ar-number">{{ $chapter->id }}</div>
                <div class="chapter-name-ar">سُورَةُ {{ $chapter->name }}</div>
                <div class="chapter-name-en">{{ $chapter->translation?->name }}</div>
                <div class="small-note ar-number">{{ $chapter->no_of_verses }} ayahs • {{ $chapter->revelation_place }}</div>
            </div>
        </header>

        <!-- FILTER / TOOLBAR (sticky) -->
        <div class="filter-toolbar mt-3" aria-hidden="false">
            <div
                class="d-flex flex-wrap align-items-center justify-content-between gap-2 p-2 bg-white shadow-sm rounded-3 border">
                <!-- Jump to Ayah -->
                <div class="control-sm">
                    <select id="jumpTo" class="form-select form-select-sm">
                        <option selected disabled>Jump to Ayah</option>
                        @foreach ($chapter->verses as $verse)
                            <option value="{{ $verse->number_in_chapter }}">Ayah - {{ $verse->number_in_chapter }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Font Size -->
                <div class="control-sm">
                    <select id="fontSize" class="form-select form-select-sm">
                        <option value="small">A-</option>
                        <option value="normal" selected>A</option>
                        <option value="large">A+</option>
                    </select>
                </div>

                <!-- View Mode Buttons -->
                <div class="control-sm">
                    <div class="btn-group btn-group-sm" role="group" aria-label="View mode">
                        <button id="modeBoth" class="btn btn-outline-success active" type="button">Both</button>
                        <button id="modeAr" class="btn btn-outline-success" type="button">Arabic</button>
                        <button id="modeTr" class="btn btn-outline-success" type="button">Translation</button>
                    </div>
                </div>

                <!-- Likes -->
                <button class="btn btn-outline-secondary btn-sm" id="btnBookmarks" aria-haspopup="dialog">
                    ❤️ Likes
                </button>

                <!-- Left: Previous Button -->
                @if ($chapter->id > 1)
                    <a class="btn btn-outline-success btn-sm" role="button"
                        href="{{ route('quran.chapter', $chapter->id - 1) }}">
                        ← Previous
                    </a>
                @endif

                <!-- Next Button -->
                @if ($chapter->id < 114)
                    <a id="nextSurah" class="btn btn-success btn-sm text-white" role="button"
                        href="{{ route('quran.chapter', $chapter->id + 1) }}">
                        Next →
                    </a>
                @endif
            </div>
        </div>

        <!-- LAYOUT: verses and side tools -->
        <div class="mt-3" id="ayahList" aria-live="polite">
            @foreach ($chapter->verses as $item)
                <article class="ayah-card" tabindex="0" id="ayah-{{ $item->number_in_chapter }}"
                    aria-label="Ayah {{ $item->number_in_chapter }}">

                    <div class="ayah-ar mb-2" style="font-size: 1.45rem;">{{ $item->text }}</div>

                    @if ($item->translation)
                        <div class="ayah-tr">{{ $item->translation->text }}</div>
                    @endif

                    <div class="ayah-actions">
                        <button class="btn btn-sm btn-success" title="Ayah Number">
                            <span class="ar-number">{{ $item->number_in_chapter }}</span>
                        </button>

                        <button class="btn btn-sm btn-outline-secondary play-btn" title="Play Ayah"
                            ata-surah="{{ $chapter->id }}" data-ayah="{{ $item->number_in_chapter }}">
                            <i class="far fa-play-circle"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-warning bookmark-btn" title="Bookmark Ayah"
                            data-id="{{ $item->id }}" data-type="quran">
                            <i class="far fa-star"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-danger like-btn" title="Like Ayah"
                            data-id="{{ $item->id }}" data-type="quran">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                </article>
            @endforeach
        </div>
    </main>

    <!-- Bookmarks Modal -->
    <div class="modal fade" id="bookmarksModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:12px;">
                <div class="modal-header">
                    <h5 class="modal-title">Bookmarks</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="bookmarksList">
                    <div class="text-muted small">No bookmarks yet.</div>
                </div>
                <div class="modal-footer">
                    <button id="clearBookmarks" class="btn btn-sm btn-outline-secondary">Clear</button>
                    <button class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('jumpTo').addEventListener('change', () => {
            const v = Number(jumpTo.value);
            if (!v) return;
            const node = document.getElementById(`ayah-${v}`);
            if (node) {
                node.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                node.focus({
                    preventScroll: true
                });
            }
        });

        // --- Search functionality ---
        const searchInput = document.getElementById('searchAyah');
        const ayahList = document.getElementById('ayahList');
        const ayahs = Array.from(ayahList.getElementsByClassName('ayah-card'));

        // --- View mode functionality ---
        const modeButtons = {
            both: document.getElementById('modeBoth'),
            ar: document.getElementById('modeAr'),
            tr: document.getElementById('modeTr'),
        };

        function setViewMode(mode) {
            ayahs.forEach(ayah => {
                const ar = ayah.querySelector('.ayah-ar');
                const tr = ayah.querySelector('.ayah-tr');
                if (!ar || !tr) return;

                if (mode === 'both') {
                    ar.style.display = '';
                    tr.style.display = '';
                } else if (mode === 'ar') {
                    ar.style.display = '';
                    tr.style.display = 'none';
                } else if (mode === 'tr') {
                    ar.style.display = 'none';
                    tr.style.display = '';
                }
            });

            // Update active button
            Object.keys(modeButtons).forEach(key => {
                modeButtons[key].classList.toggle('active', key === mode);
            });
        }

        modeButtons.both.addEventListener('click', () => setViewMode('both'));
        modeButtons.ar.addEventListener('click', () => setViewMode('ar'));
        modeButtons.tr.addEventListener('click', () => setViewMode('tr'));

        // Initialize default
        setViewMode('both');

        // --- Font size functionality ---
        const fontSizeSelect = document.getElementById('fontSize');
        fontSizeSelect.addEventListener('change', () => {
            const value = fontSizeSelect.value;
            let size;
            if (value === 'small') size = '1.2rem';
            else if (value === 'normal') size = '1.45rem';
            else if (value === 'large') size = '1.8rem';

            ayahs.forEach(ayah => {
                const ar = ayah.querySelector('.ayah-ar');
                if (ar) ar.style.fontSize = size;
            });
        });

        // Initialize font size
        fontSizeSelect.dispatchEvent(new Event('change'));
    </script>
@endpush
