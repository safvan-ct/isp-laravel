@extends('layouts.web-v2')

@section('content')
    <main class="container pb-5">
        <x-app.page-hero>
            <div class="mx-auto">
                <h3 class="text-ar text-primary">
                    سُورَةُ {{ $chapter->name }} <span class="fw-bold">.{{ $chapter->id }}</span>
                </h3>
                <h6 class="m-0 mb-2">{{ $chapter->translation?->name }}</h6>
                <p class="small-note m-0">{{ $chapter->no_of_verses }} ayahs • {{ $chapter->revelation_place }}</p>
            </div>
        </x-app.page-hero>

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
                <button class="btn btn-outline-secondary btn-sm" aria-haspopup="dialog">
                    <i class="fas fa-heart text-danger"></i> Likes
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

                    <div class="ayah-ar mb-2" style="font-size: 1.45rem;">
                        {{ $item->text }}
                        <span dir="rtl" class="text-ar ar-number fs-6">
                            ﴿{{ $item->number_in_chapter }}﴾
                        </span>
                    </div>

                    @if ($item->translation)
                        <div class="ayah-tr">
                            {{ $item->translation->text }} <span class="fs-6"> ({{ $item->number_in_chapter }}) </span>
                        </div>
                    @endif

                    <div class="actions">
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

            const $ayahs = $('#ayahList .ayah-card');

            const $modeButtons = {
                both: $('#modeBoth'),
                ar: $('#modeAr'),
                tr: $('#modeTr')
            };

            function setViewMode(mode) {
                $ayahs.each(function() {
                    const $ar = $(this).find('.ayah-ar');
                    const $tr = $(this).find('.ayah-tr');

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

                $ayahs.find('.ayah-ar').css('font-size', size);
            }).trigger('change');
        });
    </script>
@endpush
