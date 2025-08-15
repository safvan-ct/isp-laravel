@extends('layouts.web')

@section('title', __('app.bookmarks'))

@section('content')
    <x-web.container>
        <x-web.index-card class="b-top">
            <x-web.chapter-header :name="'<i class=\'fas fa-bookmark\'></i> ' . e(__('app.bookmarks'))">
                <nav aria-label="breadcrumb" class="custom-breadcrumb rounded mb-2 p-2 bg-white">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" class="text-decoration-none text-primary">{{ __('app.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('bookmarks') }}" class="text-decoration-none text-primary">
                                {{ __('app.bookmarks') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active text-muted text-capitalize" aria-current="page">
                            {{ $collection->name }}
                        </li>
                    </ol>
                </nav>

                <x-web.nav-tab />

                <div id="google_translate_element" class="mt-2 mb-0 d-none"></div>
            </x-web.chapter-header>

            <div id="result-container">
                <p class="text-center notranslate">{{ __('app.loading') }}...</p>
            </div>

            <span id="pagination-container"></span>
        </x-web.index-card>
    </x-web.container>
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
        $(function() {
            fetchLikeOrBookmark('quran');
        });

        const $container = $('#result-container');
        const $pagination = $('#pagination-container');
        const $googleTranslate = $('#google_translate_element');

        const urlMap = {
            quran: "{{ route('fetch.quran.bookmark') }}",
            hadith: "{{ route('fetch.hadith.bookmark') }}",
            topic: "{{ route('fetch.topic.bookmark') }}"
        };

        async function fetchLikeOrBookmark(type, page = 1) {
            toggleLoader(true);
            resetUI(type);

            if (!AUTH_USER) {
                showMessage("{{ __('app.no_bookmarks_found') }}");
                toggleLoader(false);
                return;
            }

            if (!urlMap[type]) {
                showMessage(`Invalid type: ${type}`);
                toggleLoader(false);
                return;
            }

            try {
                const res = await $.ajax({
                    url: urlMap[type],
                    method: 'POST',
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: JSON.stringify({
                        collection_id: "{{ $collection->id }}",
                        page
                    }),
                    dataType: 'json'
                });

                await renderResult(type, res);
                updateAllLikeIcon(type);
            } catch (error) {
                console.error(error);
                showMessage("Error loading bookmarks.");
            } finally {
                toggleLoader(false);
            }
        }

        function renderResult(type, response) {
            if (!response.html?.length) {
                showMessage("{{ __('app.no_bookmarks_found') }}");
                return;
            }

            $container.html(response.html);
            $pagination.html(response.pagination).show();

            // Bind page clicks
            $pagination.find('a.page-link').off('click').on('click', function() {
                const page = $(this).data('page');
                if (page) fetchLikeOrBookmark(type, page);
            });

            $('.ar-number').each(function() {
                const number = $(this).text().trim();
                $(this).text(toArabicNumber(number));
            });
        }

        function resetUI(type) {
            $pagination.empty().hide();
            $('.tabs').removeClass('active');
            $(`#${type}-tab`).addClass('active');
            $googleTranslate.toggleClass('d-none', type !== 'hadith');
        }

        function showMessage(message) {
            $container.html(`<p class='text-center'>${message}</p>`);
        }
    </script>
@endpush
