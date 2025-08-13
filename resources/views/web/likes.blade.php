@extends('layouts.web')

@section('title', __('app.likes'))

@section('content')
    <main class="container my-3 flex-grow-1">
        <div class="index-card" style="padding: 5px">
            <div class="chapter-header mb-2">
                <div class="chapter-name mb-2">
                    <i class="fas fa-heart"></i> {{ __('app.likes') }}
                </div>

                <ul class="nav nav-tabs justify-content-center">
                    <li class="nav-item" onclick="fetchLikes('quran')">
                        <a class="nav-link tabs" href="javascript:void(0)" id="quran-tab">{{ __('app.quran') }}</a>
                    </li>
                    <li class="nav-item" onclick="fetchLikes('hadiths')">
                        <a class="nav-link tabs" href="javascript:void(0)" id="hadiths-tab">{{ __('app.hadiths') }}</a>
                    </li>
                    <li class="nav-item" onclick="fetchLikes('topics')">
                        <a class="nav-link tabs" href="javascript:void(0)" id="topics-tab">{{ __('app.topics') }}</a>
                    </li>
                </ul>
            </div>

            <div id="likes-container">
                <p class="text-center">{{ __('app.loading') }}...</p>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    {{-- <script src="{{ asset('web/js/bookmark.js') }}"></script> --}}

    <script>
        $(async function() {
            await fetchLikes('quran');
        });

        async function fetchLikes(type) {
            $('.tabs').removeClass('active');
            $(`#${type}-tab`).addClass('active');

            if (!LIKED_ITEMS[type] || LIKED_ITEMS[type].length === 0) {
                $('#likes-container').html("<p class='text-center'>No likes found.</p>");
                return;
            }

            try {
                const urlMap = {
                    quran: "{{ route('fetch.quran.bookmark') }}",
                    hadith: "{{ route('fetch.quran.bookmark') }}",
                    topic: "{{ route('fetch.quran.bookmark') }}"
                };

                const renderMap = {
                    quran: renderQuranVerses,
                    hadith: renderHadiths,
                    topic: renderTopics
                };

                if (!urlMap[type] || !renderMap[type]) {
                    throw new Error(`Invalid type: ${type}`);
                }

                const res = await $.ajax({
                    url: urlMap[type],
                    method: 'POST',
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: JSON.stringify({
                        ids: LIKED_ITEMS[type] || []
                    }),
                    dataType: 'json'
                });

                renderMap[type](res);
            } catch (error) {
                console.error(error);
                $('#likes-container').html("<p class='text-center'>Error loading likes.</p>");
            }
        }


        function renderTopics(items) {}

        function renderHadiths(items) {}

        function renderQuranVerses(items) {
            const $container = $('#likes-container');
            $container.empty();

            if (!items.length) {
                $container.html("<p class='text-center'>No likes found.</p>");
                return;
            }

            const html = items.map(item => `
                <div class="ayah-card pb-0 item-card" data-id="${item.id}" data-type="quran">
                    <div class="ayah-arabic">
                        <span class="quran-text">${item.text}</span>
                        <span class="ayah-number ar-number">${toArabicNumber(item.number_in_chapter)}</span>
                    </div>
                    <div class="ayah-trans">${item.translations?.[0]?.text || ''}</div>

                    <div class="d-flex align-items-center justify-content-between mt-2">
                        <div class="d-flex align-items-center gap-2">
                            <a href="javascript:void(0);" class="bookmark-btn" title="Bookmark" data-type="quran" data-id="${item.id}">
                                <i class="far fa-bookmark"></i>
                            </a>
                            <a href="javascript:void(0);" class="like-btn" title="Like" data-type="quran" data-id="${item.id}">
                                <i class="fas fa-heart"></i>
                            </a>
                            <a href="javascript:void(0);" class="play-btn" data-surah="${item.chapter?.id}" data-ayah="${item.number_in_chapter}" title="Play">
                                <i class="fas fa-play"></i>
                            </a>
                        </div>

                        <p class="text-muted small notranslate fst-italic mb-0">
                            🔖 ${item.chapter?.id}.${item.chapter?.translations?.[0]?.name || item.chapter?.name}: ${item.number_in_chapter}
                        </p>
                    </div>
                </div>
            `).join('');

            $container.html(html);
        }
    </script>
@endpush
