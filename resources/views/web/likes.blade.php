@extends('layouts.web')

@section('title', __('Likes'))

@section('content')
    <main class="container my-3 flex-grow-1">
        <div class="index-card" style="padding: 5px">
            <div class="chapter-header mb-2">
                <div class="chapter-name"><i class="fas fa-heart"></i> {{ __('Likes') }}</div>
            </div>

            <div id="bookmarks-container">
                <p class="text-center">Loading {{ __('Likes') }}...</p>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('web/js/bookmark.js') }}"></script>
    <script src="{{ asset('web/js/quran-audio.js') }}"></script>

    <script>
        BOOK_MARK_COLLECTIONS = JSON.parse(localStorage.getItem('bookmarkCollections') || '{}');
        LIKED_ITEMS = JSON.parse(localStorage.getItem('likes') || '{}');

        $(async function() {
            await fetchLikes();
        });

        async function fetchLikes() {
            const $container = $('#bookmarks-container');

            if (LIKED_ITEMS.length === 0) {
                $container.html("<p class='text-center'>No bookmarks found.</p>");
                return;
            }

            try {
                const res = await $.ajax({
                    url: "{{ route('fetch.quran.bookmark') }}",
                    method: 'POST',
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: JSON.stringify({
                        ids: LIKED_ITEMS.quran
                    }),
                    dataType: 'json'
                });

                if (res.length === 0) {
                    $container.html("<p class='text-center'>No bookmarks found.</p>");
                    return;
                }

                let html = '';
                $.each(res, (i, item) => {
                    html += `
                        <div class="ayah-card learn-item" data-id="${item.id}" data-type="quran">
                            <div class="ayah-arabic">
                                <span class="quran-text">${item.text}</span>
                                <span class="ayah-number ar-number">${toArabicNumber(item.number_in_chapter)}</span>
                            </div>
                            <div class="ayah-trans">${item.translations?.[0]?.text || ''}</div>

                            <div class="ayah-actions d-flex align-items-center justify-content-between mt-2">
                                <div class="d-flex align-items-center gap-2">
                                    <a href="javascript:void(0);" class="bookmark-btn" title="Bookmark" style="color:#4E2D45;" data-type="quran" data-id="${item.id}">
                                        <i class="far fa-bookmark"></i>
                                    </a>
                                    <a href="javascript:void(0);" class="like-btn" title="Like" style="color:#4E2D45;" data-type="quran" data-id="${item.id}">
                                        <i class="fas fa-heart"></i>
                                    </a>
                                    <a href="javascript:void(0);" class="play-btn" data-surah="${item.chapter?.id}" data-ayah="${item.number_in_chapter}" title="Play" style="color:#4E2D45;">
                                        <i class="fas fa-play"></i>
                                    </a>
                                </div>

                                <p class="text-muted small notranslate fst-italic mb-0">
                                    ${item.chapter?.id}.${item.chapter?.translations?.[0]?.name || item.chapter?.name}: ${item.number_in_chapter}
                                </p>
                            </div>
                        </div>`;
                });

                $container.html(html);

                // If you want to attach event listeners to dynamically generated buttons, use delegation:
                $('.learn-item').each(function() {
                    const cardId = parseInt($(this).data('id'), 10);
                    updateIconState(cardId, $(this).data('type'));
                });

                $container.on('click', '.play-btn', function() {
                    playAudio.call(this);
                });
            } catch (error) {
                console.error(error);
                $container.html("<p class='text-center'>Error loading bookmarks.</p>");
            }
        }
    </script>
@endpush
