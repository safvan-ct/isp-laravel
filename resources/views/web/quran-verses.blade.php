@extends('layouts.web')

@section('title', __('app.quran') . ' | ' . ($chapter->translation?->name ?: $chapter->name))

@section('content')
    <main class="container my-3 flex-grow-1">
        <div class="index-card" style="padding: 5px">
            <div class="chapter-header mb-2">
                <div class="chapter-name">
                    {{ optional($chapter->translation)->name ? $chapter->translation->name . ' | ' : '' }}{{ $chapter->name }}
                </div>

                <div>
                    {{ __('app.chapter') }}: <strong class="ar-number">{{ $chapter->id }}</strong> |
                    {{ __('app.ayahs') }}: <strong class="ar-number">{{ $chapter->no_of_verses }}</strong>
                </div>
            </div>

            @foreach ($chapter->verses as $item)
                <div class="ayah-card item-card pb-0" data-id="{{ $item->id }}" data-type="quran">
                    <div class="ayah-arabic">
                        <span class="quran-text">{{ $item->text }}</span>
                        <span class="ayah-number ar-number">{{ $item->number_in_chapter }}</span>
                    </div>

                    @if ($item->translation)
                        <div class="ayah-trans">{{ $item->translation->text }}</div>
                    @endif

                    <!-- Action Icons -->
                    <div class="d-flex align-items-center mt-1 gap-2 justify-content-end">
                        <a href="javascript:void(0);" class="play-btn text-decoration-none"
                            data-surah="{{ $chapter->id }}" data-ayah="{{ $item->number_in_chapter }}" title="Play">
                            <i class="fas fa-play fs-6"></i>
                        </a>
                        <a href="javascript:void(0);" class="bookmark-btn text-decoration-none"
                            data-id="{{ $item->id }}" data-type="quran" title="Bookmark">
                            <i class="far fa-bookmark fs-6"></i>
                        </a>
                        <a href="javascript:void(0);" class="like-btn text-decoration-none" data-id="{{ $item->id }}"
                            data-type="quran" title="Like">
                            <i class="far fa-heart fs-6"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        $(function() {
            updateAllLikeIcon('quran');
            updateAllBookmarkIcon('quran');
        });
    </script>
@endpush
