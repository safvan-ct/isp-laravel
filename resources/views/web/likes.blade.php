@extends('layouts.web')

@section('title', __('app.likes'))

@section('content')
    <main class="container my-3 flex-grow-1">
        <div class="index-card" style="padding: 5px">
            <div class="chapter-header mb-2 notranslate">
                <div class="chapter-name mb-2">
                    <i class="fas fa-heart"></i> {{ __('app.likes') }}
                </div>

                <ul class="nav nav-tabs justify-content-center">
                    <li class="nav-item" onclick="fetchLikes('quran')">
                        <a class="nav-link tabs" href="javascript:void(0)" id="quran-tab">{{ __('app.quran') }}</a>
                    </li>
                    <li class="nav-item" onclick="fetchLikes('hadith')">
                        <a class="nav-link tabs" href="javascript:void(0)" id="hadith-tab">{{ __('app.hadiths') }}</a>
                    </li>
                    <li class="nav-item" onclick="fetchLikes('topic')">
                        <a class="nav-link tabs" href="javascript:void(0)" id="topic-tab">{{ __('app.topics') }}</a>
                    </li>
                </ul>

                <div id="google_translate_element" class="mt-2 mb-0 d-none"></div>
            </div>

            <div id="likes-container">
                <p class="text-center notranslate">{{ __('app.loading') }}...</p>
            </div>

            <nav aria-label="Likes Pagination" class="mt-2" id="pagination-nav">
                <ul id="likes-pagination" class="pagination justify-content-center mb-1"></ul>
            </nav>
        </div>
    </main>
@endsection

@push('scripts')
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                    pageLanguage: 'en',
                    includedLanguages: 'ml,hi',
                    layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                    autoDisplay: false
                },
                'google_translate_element'
            );
        }
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>

    <script>
        $(async function() {
            await fetchLikes('quran');
        });

        async function fetchLikes(type, page = 1) {
            $('#pageLoader').removeClass('d-none');
            $('#likes-pagination').empty();
            $('#google_translate_element').addClass('d-none');
            $('.tabs').removeClass('active');
            $(`#${type}-tab`).addClass('active');

            if (type === 'hadith') {
                $('#google_translate_element').removeClass('d-none');
            }

            const likes = JSON.parse(localStorage.getItem('likes') || '{}');
            const hasNoLikes = !(likes[type] && likes[type].length > 0);

            if (!AUTH_USER && hasNoLikes) {
                $('#likes-container').html("<p class='text-center'>{{ __('app.no_likes_found') }}</p>");
                $('#pageLoader').addClass('d-none');
                return;
            }

            try {
                const urlMap = {
                    quran: "{{ route('fetch.quran.like') }}",
                    hadith: "{{ route('fetch.hadith.like') }}",
                    topic: "{{ route('fetch.topic.like') }}"
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
                        ids: Array.from(likes[type] || []) || [],
                        page: page
                    }),
                    dataType: 'json'
                });

                renderMap[type](res);
                updateAllBookmarkIcon(type);

                setTimeout(() => {
                    $('#pageLoader').addClass('d-none');
                }, 100);
            } catch (error) {
                $('#pageLoader').addClass('d-none');
                console.error(error);
                $('#likes-container').html("<p class='text-center'>Error loading likes.</p>");
            }
        }

        function setPagination(type, meta) {
            $('#pagination-nav').show();
            const $pagination = $('#likes-pagination');
            let paginationHtml = '';

            const totalPages = meta.last_page;
            const current = meta.current_page;
            const delta = 3; // show 2 neighbors

            $pagination.empty();

            if (totalPages <= 1) {
                $('#pagination-nav').hide();
                return;
            }

            // Bootstrap Pagination with ellipsis
            const createPageItem = (page, label = null, active = false, disabled = false) => {
                return `<li class="page-item ${active ? 'active' : ''} ${disabled ? 'disabled' : ''}">
                        <a class="page-link" href="javascript:void(0);" data-page="${page}">${label || page}</a>
                    </li>`;
            };

            // Previous
            paginationHtml += createPageItem(meta.current_page - 1, 'Previous', false, meta.current_page === 1);

            let range = [];
            for (let i = 1; i <= totalPages; i++) {
                if (i === 1 || i === totalPages || (i >= current - delta && i <= current + delta)) {
                    range.push(i);
                }
            }

            let lastPage = 0;
            range.forEach(page => {
                if (page - lastPage > 1) {
                    paginationHtml += `<li class="page-item disabled"><span class="page-link">…</span></li>`;
                }

                paginationHtml += createPageItem(page, null, page === current);
                lastPage = page;
            });

            // Next
            paginationHtml += createPageItem(meta.current_page + 1, 'Next', false, meta.current_page === totalPages);

            $pagination.html(paginationHtml);

            // Handle page click
            $pagination.find('a.page-link').click(function() {
                const page = $(this).data('page');
                if (page >= 1 && page <= totalPages) {
                    fetchLikes(type, page);
                }
            });
        }

        function renderQuranVerses(response) {
            const items = response.data;
            const meta = response.meta;

            const $container = $('#likes-container');
            $container.empty();

            if (!items.length) {
                $container.html("<p class='text-center'>{{ __('app.no_likes_found') }}</p>");
                return;
            }

            const html = items.map(item => `
                <div class="ayah-card pb-0 item-card notranslate" data-id="${item.id}" data-type="quran">
                    <div class="ayah-arabic">
                        <span class="quran-text">${item.text}</span>
                        <span class="ayah-number ar-number">${toArabicNumber(item.number_in_chapter)}</span>
                    </div>
                    <div class="ayah-trans">${item.translations?.[0]?.text || ''}</div>

                    <div class="d-flex align-items-center justify-content-between mt-2">
                        <p class="text-muted small notranslate fst-italic mb-0">
                            🔖 ${item.chapter?.id}.${item.chapter?.translations?.[0]?.name || item.chapter?.name}: ${item.number_in_chapter}
                        </p>

                        <div class="d-flex align-items-center gap-2">
                            <a href="javascript:void(0);" class="play-btn" data-surah="${item.chapter?.id}" data-ayah="${item.number_in_chapter}" title="Play">
                                <i class="fas fa-play fs-5"></i>
                            </a>
                            <a href="javascript:void(0);" class="bookmark-btn" title="Bookmark" data-type="quran" data-id="${item.id}">
                                <i class="far fa-bookmark fs-5"></i>
                            </a>
                            <a href="javascript:void(0);" class="like-btn" title="Like" data-type="quran" data-id="${item.id}">
                                <i class="fas fa-heart fs-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            `).join('');

            $container.html(html);
            setPagination('quran', meta);
        }

        function renderHadiths(response) {
            const items = response.data;
            const meta = response.meta;

            const $container = $('#likes-container');
            $container.empty();

            if (!items.length) {
                $container.html("<p class='text-center'>{{ __('app.no_likes_found') }}</p>");
                return;
            }

            const html = items.map(item => `
                <div class="ayah-card pb-0 item-card" data-id="${item.id}" data-type="hadith">
                    ${item.heading ? `
                                                    <div class="row flex-column flex-md-row">
                                                        <div class="col-12 col-md-6 order-1 order-md-2">
                                                            <h6 class="ayah-arabic notranslate fw-bold hadith-text fs-5 m-0" style="line-height: 1.6;">
                                                                ${item.heading}
                                                            </h6>
                                                        </div>

                                                        <div class="col-12 col-md-6 order-2 order-md-1">
                                                            <h6 class="fw-bold fs-6 hadith-tr-text">${item.translations?.[0]?.heading}</h6>
                                                        </div>
                                                    </div>
                                                    <hr>` : ''}

                    <div class="row flex-column flex-md-row">
                        <div class="col-12 col-md-6 order-1 order-md-2">
                            <div class="ayah-arabic notranslate hadith-text" style="font-size: 20px; line-height: 1.6;">
                                ${item.text}
                                (<span class="fst-italic fs-6 ar-number">${toArabicNumber(item.hadith_number)}</span>)
                            </div>
                        </div>

                        <div class="col-12 col-md-6 order-2 order-md-1">
                            <div class="text-en hadith-tr-text">${item.translations?.[0]?.text}</div>
                        </div>
                    </div>
                    <hr>

                    <div class="d-flex align-items-center justify-content-between mt-0">
                        <p class="text-muted small notranslate fst-italic">
                            🔖 ${item.book.translations?.[0]?.name ?? $item.book.name},
                            {{ __('app.volume') }}: ${item.volume},
                            {{ __('app.chapter') }}: #${item.chapter.chapter_number} - ${item.chapter.translations?.[0]?.name ?? item.chapter.name},
                            {{ __('app.hadith') }}: #${item.hadith_number},
                            {{ __('app.status') }}: ${item.status || 'Unknown'}
                        </p>

                        <div class="d-flex align-items-center mt-1 gap-2">
                            <a href="javascript:void(0);" class="bookmark-btn text-decoration-none"
                                data-id="${item.id}" data-type="hadith" title="Bookmark">
                                <i class="far fa-bookmark fs-5"></i>
                            </a>

                            <a href="javascript:void(0);" class="like-btn text-decoration-none" data-id="${item.id}"
                                data-type="hadith" title="Like">
                                <i class="fas fa-heart fs-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            `).join('');

            $container.html(html);
            setPagination('hadith', meta);
        }

        function renderTopics(response) {
            const items = response.data;
            const meta = response.meta;

            const $container = $('#likes-container');
            $container.empty();

            if (!items.length) {
                $container.html("<p class='text-center'>{{ __('app.no_likes_found') }}</p>");
                return;
            }

            const html = items.map(item => {
                itemMenu = item.parent?.parent?.parent;
                itemModule = item.parent?.parent;
                itemQuestion = item.parent;

                ref = `<p class="text-muted small notranslate fst-italic">
                        🔖 ${itemMenu.translations?.[0]?.title ?? itemMenu.slug} >
                        ${itemModule.translations?.[0]?.title ?? itemModule.slug} >
                        ${itemQuestion.translations?.[0]?.title ?? itemQuestion.slug}
                    </p>`;

                content = `
                    <div class="mt-1 pb-1 section-card notranslate">
                        <h2 class="mb-0">${item.translations?.[0]?.title ?? item.slug}</h2>
                        ${item.translations?.[0]?.content ? `<p class="mb-0">${item.translations?.[0]?.content}</p>` : ''}
                        <hr>

                        <div class="d-flex justify-content-between align-items-center item-card" data-id="${item.id}"
                            data-type="topic">
                            ${ref}

                            <div class="d-flex gap-2">
                                <a href="javascript:void(0);" class="bookmark-btn text-decoration-none"
                                    data-id="${item.id}" data-type="topic" title="Bookmark">
                                    <i class="far fa-bookmark fs-5"></i>
                                </a>

                                <a href="javascript:void(0);" class="like-btn text-decoration-none" data-id="${item.id}"
                                    data-type="topic" title="Like">
                                    <i class="fas fa-heart fs-5"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                `;

                return content;
            }).join('');

            $container.html(html);
            setPagination('topic', meta);
        }
    </script>
@endpush
