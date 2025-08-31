@extends('layouts.web-v2')

@section('content')
    <!-- HERO -->
    <main class="container">
        <x-app.page-hero :title="'Al-Qur’an — All 114 Surahs'" :description="'Search, filter and jump by Juz — designed for calm, focused study.'" />

        <x-app.filter>
            <div class="row g-2 pb-2 bg-white shadow-sm rounded border">
                <div class="col-12 col-md-6">
                    <input id="searchInput" class="form-control form-control-sm" placeholder="Search Surah by number or name…"
                        aria-label="Search Surahs">
                </div>

                <div class="col-12 col-md-auto ms-md-auto d-flex gap-2 justify-content-end">
                    <div class="view-toggle btn-group" role="group" aria-label="Switch view">
                        <button id="btnGrid" type="button" class="btn btn-sm btn-outline-success active">Grid
                            view</button>
                        <button id="btnJuz" type="button" class="btn btn-sm btn-outline-secondary">Juz view</button>
                    </div>
                </div>
            </div>
        </x-app.filter>

        <!-- Grid (default) -->
        <section id="gridView" class="my-3">
            <div id="surahGrid" class="row g-2">
                @foreach ($chapters as $chapter)
                    <div class="col-md-6 col-lg-4 all-chapters"
                        onclick="window.location.href = '{{ route('quran.chapter', $chapter->id) }}'"
                        style="cursor: pointer">
                        <div class="card d-flex justify-content-between align-items-center flex-row rounded-0"
                            data-surah="{{ $chapter->id }}">
                            <div class="d-flex gap-3 align-items-center">
                                <div class="number-box"><span>{{ $chapter->id }}</span></div>

                                <div>
                                    <h6 class="text-primary fw-bold m-0">{{ $chapter->translation?->name }}</h6>
                                    <p class="text-muted m-0 small">{{ $chapter->translation?->translation }}</p>
                                </div>
                            </div>

                            <div class="justify-content-end">
                                <p class="text-arabic m-0">{{ $chapter->name }}</p>
                                <p class="small m-0 text-muted">{{ $chapter->no_of_verses }} Ayahs</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Juz view (hidden by default) -->
        <section id="juzView" class="my-3 d-none">
            <div id="juzAccordion">
                @foreach ($juzs as $item)
                    @php
                        $range = $item['range'] ?? '';
                        $startRange = trim(explode(' - ', $range)[0] ?? $range);
                        $start = trim(explode(':', $startRange)[0] ?? $startRange);
                    @endphp

                    <div class="card mb-2 rounded-0 shadow-sm" id="juz-{{ $item['number'] }}">
                        <div class="d-flex justify-content-between flex-column flex-md-row">
                            <div class="flex-row d-flex align-items-center justify-content-between">
                                <h6 class="text-primary fw-bold me-3">Juz {{ $item['number'] }}</h6>
                                <div>
                                    <p class="small fw-bold mb-0">{{ $item['title'] }}</p>
                                    <p class="small text-muted mb-0">{{ $range }}</p>
                                </div>
                            </div>

                            <div class="text-md-end mt-2 mt-md-0">
                                <button type="button" class="btn btn-sm btn-outline-secondary open-juz mb-1"
                                    data-start="{{ $start }}" data-range="{{ $startRange }}"
                                    aria-label="Open Juz {{ $item['number'] }}">
                                    Open
                                </button>
                                <p class="small text-muted mb-0">
                                    This Juz starts at <strong>{{ explode(' - ', $item['range'])[0] }}</strong>.
                                    Click <em>Open</em> to jump to the Surah that contains this starting verse.
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        $(function() {
            let debounceTimer;

            // 🔎 Search filter
            $('#searchInput').on('input', function() {
                clearTimeout(debounceTimer);
                const query = $(this).val().trim().toLowerCase();

                debounceTimer = setTimeout(() => {
                    $('#surahGrid .all-chapters').each(function() {
                        const $chapter = $(this);
                        const surahNameAr = $chapter.find('.surah-name-ar').text()
                            .toLowerCase();
                        const surahNameEn = $chapter.find('.fw-semibold').text()
                            .toLowerCase();
                        const surahNumber = $chapter.find('.surah-number').text()
                            .toLowerCase();

                        $chapter.toggle(
                            surahNumber.includes(query) ||
                            surahNameAr.includes(query) ||
                            surahNameEn.includes(query)
                        );
                    });
                }, 180);
            });

            // 📍 Jump to Surah
            $('#surahGrid').on('click', '.btn-jump', function() {
                const n = $(this).data('target');
                const $el = $(`#surahGrid [data-surah='${n}']`);

                if ($el.length) {
                    $el[0].scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                    $el.trigger('focus');
                }
            });

            // 📖 Open Juz
            $('#juzAccordion').on('click', '.open-juz', function() {
                const startSurah = $(this).data('start');
                showGrid();

                setTimeout(() => {
                    const $el = $(`[data-surah='${startSurah}']`);
                    if ($el.length) {
                        $el[0].scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        $el.trigger('focus');
                    } else {
                        alert('Target Surah not found in grid (unexpected).');
                    }
                }, 220);
            });

            // 🔄 View toggles
            $('#btnGrid').on('click', showGrid);
            $('#btnJuz').on('click', showJuz);

            function showGrid() {
                $('#gridView').removeClass('d-none');
                $('#juzView').addClass('d-none');
                $('#btnGrid').addClass('active');
                $('#btnJuz').removeClass('active');
            }

            function showJuz() {
                $('#gridView').addClass('d-none');
                $('#juzView').removeClass('d-none');
                $('#btnJuz').addClass('active');
                $('#btnGrid').removeClass('active');
            }
        });
    </script>
@endpush
