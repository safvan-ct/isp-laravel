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

        async function fetchLikes(type) {
            $('#google_translate_element').addClass('d-none');
            $('.tabs').removeClass('active');
            $(`#${type}-tab`).addClass('active');

            if (type === 'hadith') {
                $('#google_translate_element').removeClass('d-none');
            }

            if (!LIKED_ITEMS[type] || LIKED_ITEMS[type].length === 0) {
                $('#likes-container').html("<p class='text-center'>No likes found.</p>");
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

        function renderQuranVerses(items) {
            const $container = $('#likes-container');
            $container.empty();

            if (!items.length) {
                $container.html("<p class='text-center'>No likes found.</p>");
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

        function renderHadiths(items) {
            const $container = $('#likes-container');
            $container.empty();

            if (!items.length) {
                $container.html("<p class='text-center'>No likes found.</p>");
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
                                <hr>
                            ` : ''}

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

                    <p class="text-muted small notranslate fst-italic">
                        🔖 ${item.book.translations?.[0]?.name ?? $item.book.name},

                        {{ __('app.volume') }}: ${item.volume},

                        {{ __('app.chapter') }}: #${item.chapter.chapter_number} - ${item.chapter.translations?.[0]?.name ?? item.chapter.name},

                        {{ __('app.hadith') }}: #${item.hadith_number},

                        {{ __('app.status') }}: ${item.status || 'Unknown'}
                    </p>

                    <!-- Action Icons -->
                    <div class="d-flex align-items-center mt-1 gap-2">
                        <a href="javascript:void(0);" class="bookmark-btn text-decoration-none"
                            data-id="${item.id}" data-type="hadith" title="Bookmark">
                            <i class="far fa-bookmark"></i>
                        </a>

                        <a href="javascript:void(0);" class="like-btn text-decoration-none" data-id="${item.id}"
                            data-type="hadith" title="Like">
                            <i class="fas fa-heart"></i>
                        </a>
                    </div>
                </div>
            `).join('');

            $container.html(html);
        }

        function renderTopics(items) {
            const $container = $('#likes-container');
            $container.empty();

            if (!items.length) {
                $container.html("<p class='text-center'>No likes found.</p>");
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
                    <div class="mb-2 section-card notranslate">
                        <div class="d-flex justify-content-between align-items-center item-card" data-id="${item.id}"
                            data-type="topic">
                            <h2 class="mb-0">${item.translations?.[0]?.title ?? item.slug}</h2>

                            <div class="d-flex gap-2">
                                <a href="javascript:void(0);" class="like-btn text-decoration-none" data-id="${item.id}"
                                    data-type="topic" title="Like">
                                    <i class="fas fa-heart"></i>
                                </a>

                                <a href="javascript:void(0);" class="bookmark-btn text-decoration-none"
                                    data-id="${item.id}" data-type="topic" title="Bookmark">
                                    <i class="far fa-bookmark"></i>
                                </a>
                            </div>
                        </div>

                        ${item.translations?.[0]?.content ? `<p class="mb-0">${item.translations?.[0]?.content}</p>` : ''}
                        <hr>
                        ${ref}
                    </div>
                `;

                return content;
            }).join('');

            $container.html(html);
        }
    </script>
@endpush
