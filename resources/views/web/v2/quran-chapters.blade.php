@extends('layouts.web-v2')

@push('styles')
    <style>
        .surah-card {
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 16px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: 0.2s ease-in-out;
        }

        .surah-card:hover {
            background: #fafafa;
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            cursor: pointer;
        }

        .surah-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .number-box {
            width: 48px;
            height: 48px;
            background: #f5f5f5;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #333;
            transform: rotate(45deg);
        }

        .number-box span {
            transform: rotate(-45deg);
            display: inline-block;
        }

        .surah-name {
            font-weight: 600;
            font-size: 1rem;
            color: #222;
        }

        .surah-translation {
            font-size: 0.85rem;
            color: #777;
        }

        .surah-right {
            text-align: right;
        }

        .arabic-name {
            font-family: "Scheherazade New", serif;
            font-size: 1.2rem;
            color: #111;
        }

        .ayah-count {
            font-size: 0.85rem;
            color: #555;
        }
    </style>
@endpush

@section('content')
    <!-- HERO -->
    <main class="container">
        <x-app.page-hero :title="'Al-Qur’an — All 114 Surahs'" :description="'Search, filter and jump by Juz — designed for calm, focused study.'" />

        <x-app.filter>
            <div
                class="d-flex flex-wrap align-items-center justify-content-between gap-2 p-2 bg-white shadow-sm rounded-3 border">
                <div class="search">
                    <input id="searchInput" class="form-control" placeholder="Search Surah by number or name…"
                        aria-label="Search Surahs">
                </div>

                <div class="view-toggle btn-group" role="group" aria-label="Switch view">
                    <button id="btnGrid" type="button" class="btn btn-sm btn-outline-success active">Grid view</button>
                    <button id="btnJuz" type="button" class="btn btn-sm btn-outline-secondary">Juz view</button>
                </div>
            </div>
        </x-app.filter>


        {{-- <div class="filter-toolbar mt-3 d-none">
            <div
                class="d-flex flex-wrap align-items-center justify-content-between gap-2 p-2 bg-white shadow-sm rounded-3 border">
                <div class="search">
                    <input id="searchInput" class="form-control" placeholder="Search Surah by number or name…"
                        aria-label="Search Surahs">
                </div>

                <div class="view-toggle btn-group" role="group" aria-label="Switch view">
                    <button id="btnGrid" type="button" class="btn btn-sm btn-outline-success active">Grid view</button>
                    <button id="btnJuz" type="button" class="btn btn-sm btn-outline-secondary">Juz view</button>
                </div>
            </div>
        </div> --}}

        <!-- Grid (default) -->
        <section id="gridView" class="my-3">
            <div id="surahGrid" class="row g-2">
                @foreach ($chapters as $chapter)
                    <div class="col-md-6 col-lg-4 all-chapters" onclick="window.location.href = '{{ route('quran.chapter', $chapter->id) }}'">
                        <div class="surah-card" tabindex="0" data-surah="{{ $chapter->id }}">
                            <div class="surah-left">
                                <div class="number-box"><span>{{ $chapter->id }}</span></div>
                                <div>
                                    <div class="surah-name">{{ $chapter->translation?->name }}</div>
                                    <div class="surah-translation">{{ $chapter->translation?->translation }}</div>
                                </div>
                            </div>
                            <div class="surah-right">
                                <div class="arabic-name">{{ $chapter->name }}</div>
                                <div class="ayah-count">{{ $chapter->no_of_verses }} Ayahs</div>
                            </div>
                        </div>
                    </div>

                    <div class='col-6 col-md-4 col-lg-3 all-chapters d-none'>
                        <article class="surah-card" tabindex="0" data-surah="{{ $chapter->id }}">
                            <div class="d-flex align-items-center mb-2">
                                <div class="surah-number">{{ $chapter->id }}</div>
                                <div>
                                    <div class="surah-name-ar"><span class="surah">سُورَةُ </span>{{ $chapter->name }}
                                    </div>
                                    <div class="fw-semibold mt-2">{{ $chapter->translation?->name }}</div>
                                </div>
                            </div>

                            <div class="small-note">
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
