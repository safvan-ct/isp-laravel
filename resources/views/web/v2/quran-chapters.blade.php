@extends('layouts.web-v2')

@section('content')
    <!-- HERO -->
    <main class="container">
        <x-app.page-hero :title="'Al-Qur’an — All 114 Surahs'" :description="'Search, filter and jump by Juz — designed for calm, focused study.'" />

        <div class="filter-toolbar mt-3" aria-hidden="false">
            <div
                class="d-flex flex-wrap align-items-center justify-content-between gap-2 p-2 bg-white shadow-sm rounded-3 border">
                <div class="search">
                    <label for="qSearch" class="visually-hidden">Search Surahs</label>
                    <input id="qSearch" class="form-control form-control"
                        placeholder="Search Surah by number, Arabic or English name…" aria-label="Search Surahs">
                </div>

                <div class="view-toggle btn-group" role="group" aria-label="Switch view">
                    <button id="btnGrid" type="button" class="btn btn-sm btn-outline-success active">Grid view</button>
                    <button id="btnJuz" type="button" class="btn btn-sm btn-outline-secondary">Juz view</button>
                </div>
            </div>
        </div>

        <!-- Grid (default) -->
        <section id="gridView" class="my-3">
            <div id="surahGrid" class="row g-2">
                @foreach ($chapters as $chapter)
                    <div class='col-6 col-md-4 col-lg-3 all-chapters'>
                        <article class="surah-card" tabindex="0" data-surah="{{ $chapter->id }}">
                            <div class="d-flex align-items-center mb-2">
                                <div class="surah-number">{{ $chapter->id }}</div>
                                <div>
                                    <div class="surah-name-ar">سُورَةُ {{ $chapter->name }}</div>
                                    <div class="fw-semibold">{{ $chapter->translation?->name }}</div>
                                </div>
                            </div>

                            <div class="small-note ar-number">
                                {{ $chapter->no_of_verses }} ayahs • {{ $chapter->revelation_place }}
                            </div>

                            <div class="mt-3 d-flex gap-2">
                                <a class="btn btn-outline-success btn-sm" href="{{ route('quran.chapter', $chapter->id) }}">
                                    Read
                                </a>
                                <button class="btn btn-sm btn-outline-secondary btn-jump" data-target="{{ $chapter->id }}">
                                    Jump
                                </button>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Juz view (hidden by default) -->
        <section id="juzView" class="d-none my-3">
            <div class="accordion" id="juzAccordion">
                @foreach ($juzs as $item)
                    <div class="accordion-item mb-2">
                        <h2 class="accordion-header" id="heading{{ $item['number'] }}">
                            <div class="collapsed d-flex align-items-center">
                                <h5 class="me-3 ms-3"><strong>Juz {{ $item['number'] }}</strong></h5>
                                <div class="flex-fill text-start ms-2 mt-2">
                                    <h6>{{ $item['title'] }}</h6>
                                    <p class="small-note">{{ $item['range'] }}</p>
                                </div>
                                <div class="ms-auto"></div>
                            </div>

                            <button class="btn btn-sm btn-outline-secondary open-juz ms-3"
                                data-start="{{ explode(':', explode(' - ', $item['range'])[0])[0] }}">
                                Open
                            </button>

                            <div class="small-note m-3">
                                This Juz starts at <strong>{{ explode(' - ', $item['range'])[0] }}</strong>. Click
                                <em>Open</em> to jump to the Surah that contains this starting verse.
                            </div>
                        </h2>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        let debounceTimer;

        document.getElementById('qSearch').addEventListener('input', (e) => {
            clearTimeout(debounceTimer);

            const query = e.target.value.trim().toLowerCase();

            debounceTimer = setTimeout(() => {
                filterSurahs(query);
            }, 180);
        });

        function filterSurahs(query) {
            const allChapters = document.querySelectorAll('#surahGrid .all-chapters');

            allChapters.forEach((chapterDiv) => {
                const surahNameAr = chapterDiv.querySelector('.surah-name-ar')?.textContent.toLowerCase() || '';
                const surahNameEn = chapterDiv.querySelector('.fw-semibold')?.textContent.toLowerCase() || '';
                const surahNumber = chapterDiv.querySelector('.surah-number')?.textContent.toLowerCase() || '';

                // Check if the query matches number, Arabic name, or English name
                if (
                    surahNumber.includes(query) ||
                    surahNameAr.includes(query) ||
                    surahNameEn.includes(query)
                ) {
                    chapterDiv.style.display = 'block';
                } else {
                    chapterDiv.style.display = 'none';
                }
            });
        }

        document.getElementById('surahGrid').querySelectorAll('.btn-jump').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const n = Number(btn.dataset.target);

                const el = document.getElementById('surahGrid').querySelector(`[data-surah='${n}']`);
                if (el) {
                    el.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                    el.focus({
                        preventScroll: true
                    });
                }
            });
        });

        document.getElementById('juzAccordion').querySelectorAll('.open-juz').forEach(btn => {
            btn.addEventListener('click', () => {
                const startSurah = Number(btn.dataset.start);
                // switch to grid view if needed
                showGrid();
                // after small timeout to ensure grid visible, scroll
                setTimeout(() => {
                    const el = document.querySelector(`[data-surah='${startSurah}']`);
                    if (el) {
                        el.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        el.focus({
                            preventScroll: true
                        });
                    } else {
                        // if the surah element isn't rendered (shouldn't happen), show a notice
                        alert('Target Surah not found in grid (unexpected).');
                    }
                }, 220);
            });
        });

        // view toggles
        document.getElementById('btnGrid').addEventListener('click', showGrid);
        document.getElementById('btnJuz').addEventListener('click', showJuz);

        function showGrid() {
            document.getElementById('gridView').classList.remove('d-none');
            document.getElementById('juzView').classList.add('d-none');
            document.getElementById('btnGrid').classList.add('active');
            document.getElementById('btnJuz').classList.remove('active');
        }

        function showJuz() {
            document.getElementById('gridView').classList.add('d-none');
            document.getElementById('juzView').classList.remove('d-none');
            document.getElementById('btnJuz').classList.add('active');
            document.getElementById('btnGrid').classList.remove('active');
        }
    </script>
@endpush
