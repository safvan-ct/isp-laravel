@extends('layouts.web-v2')

@section('content')
    <main class="container pb-5">
        <x-app.page-hero>
            <div class="text-center">
                <h4 class="text-arabic text-primary">
                    سُورَةُ {{ $chapter->name }} <span class="fw-bold">.{{ $chapter->id }}</span>
                </h4>
                <h6 class="small mb-0">{{ $chapter->translation?->name }}</h6>
                <p class="small text-muted m-0">{{ $chapter->no_of_verses }} ayahs • {{ $chapter->revelation_place }}</p>
            </div>
        </x-app.page-hero>

        <x-app.filter>
            <div class="row g-2 pb-2 bg-white shadow-sm rounded border">
                <div class="col-6 col-md-auto">
                    <select id="jumpTo" class="form-select form-select-sm">
                        <option selected disabled>Jump to Ayah</option>
                        @foreach ($chapter->verses as $verse)
                            <option value="{{ $verse->number_in_chapter }}">Ayah - {{ $verse->number_in_chapter }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-6 col-md-auto">
                    <select id="fontSize" class="form-select form-select-sm">
                        <option value="small">A-</option>
                        <option value="normal" selected>A</option>
                        <option value="large">A+</option>
                    </select>
                </div>

                <div class="col-auto">
                    <div class="btn-group btn-group-sm" role="group" aria-label="View mode">
                        <button id="modeBoth" class="btn btn-outline-success active" type="button">Both</button>
                        <button id="modeAr" class="btn btn-outline-success" type="button">Arabic</button>
                        <button id="modeTr" class="btn btn-outline-success" type="button">Translation</button>
                    </div>
                </div>

                <div class="col-auto">
                    <button class="btn btn-outline-secondary btn-sm" aria-haspopup="dialog">
                        <i class="fas fa-heart text-danger"></i> Likes
                    </button>
                </div>

                <div class="col-12 col-md-auto ms-md-auto d-flex gap-2 justify-content-end">
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
        </x-app.filter>

        <div class="mt-2" id="ayahList">
            @foreach ($chapter->verses as $item)
                <article class="card-surface pt-4 mb-2" tabindex="0" id="ayah-{{ $item->number_in_chapter }}">
                    <h4 class="text-arabic mb-2 text-primary lh-xl">
                        {{ $item->text }}
                        <span dir="rtl" class="ar-number fs-6">﴿{{ $item->number_in_chapter }}﴾</span>
                    </h4>

                    @if ($item->translation)
                        <p class="mb-2">{{ $item->translation->text }} ({{ $item->number_in_chapter }})</p>
                    @endif

                    <div class="d-flex gap-2 align-items-center justify-content-end">
                        <button class="btn btn-sm btn-outline-success play-btn" title="Play Ayah"
                            data-surah="{{ $chapter->id }}" data-ayah="{{ $item->number_in_chapter }}">
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
@endsection

@push('scripts')
    <script>
        $(function() {
            $(document).on('click', '.play-btn', function() {
                playAudio.call(this);
            });

            $('#jumpTo').on('change', function() {
                const v = Number($(this).val());
                if (!v) return;

                const $node = $(`#ayah-${v}`);
                if ($node.length) {
                    $node[0].scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                    $node.trigger('focus');
                }
            });

            const $ayahs = $('#ayahList .card-surface');

            const $modeButtons = {
                both: $('#modeBoth'),
                ar: $('#modeAr'),
                tr: $('#modeTr')
            };

            function setViewMode(mode) {
                $ayahs.each(function() {
                    const $ar = $(this).find('.text-arabic');
                    const $tr = $(this).find('p');

                    if (mode === 'both') {
                        $ar.show();
                        $tr.show();
                    } else if (mode === 'ar') {
                        $ar.show();
                        $tr.hide();
                    } else if (mode === 'tr') {
                        $ar.hide();
                        $tr.show();
                    }
                });

                $.each($modeButtons, (key, $btn) => {
                    $btn.toggleClass('active', key === mode);
                });
            }

            $modeButtons.both.on('click', () => setViewMode('both'));
            $modeButtons.ar.on('click', () => setViewMode('ar'));
            $modeButtons.tr.on('click', () => setViewMode('tr'));

            setViewMode('both');

            $('#fontSize').on('change', function() {
                const val = $(this).val();
                let size =
                    val === 'small' ? '1.2rem' :
                    val === 'large' ? '1.8rem' :
                    '1.45rem';

                $ayahs.find('.text-arabic').css('font-size', size);
            }).trigger('change');
        });
    </script>
@endpush
