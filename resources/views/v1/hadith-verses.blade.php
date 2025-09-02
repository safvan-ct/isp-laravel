@extends('layouts.app')

@section('content')
    <main class="container">
        <header class="page-hero notranslate">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('app.home') }}</a></li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('hadith.index') }}">{{ __('app.hadith') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('hadith.chapters', [$chapter->book->id]) }}">
                            {{ $chapter->book->translation?->name ?? $chapter->book->name }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $chapter->translation?->name ?? $chapter->name }}
                    </li>
                </ol>
            </nav>

            <hr class="mt-1 mb-3">

            <div class="text-center mb-2">
                <h4 class="text-primary fw-bold text-Playfair text-tr">
                    {{ $chapter->translation?->name ?? $chapter->name }} —
                    <em class="text-muted small">{{ $chapter->book->translation?->name ?? $chapter->book->name }} </em>
                </h4>
                <p class='small text-muted m-0'>
                    {{ $chapter->book->translation?->writer ?? $chapter->book->writer }}
                    ({{ $chapter->book->writer_death_year }}H)
                </p>
                <p class="small text-muted m-0">
                    {{ __('app.chapter') }}: <strong>{{ $chapter->chapter_number }}</strong> •
                    {{ __('app.hadiths') }}: <strong>{{ $chapter->verses->count() }}</strong>
                </p>

                <div id="google_translate_element" class="mt-2 mb-0"></div>
            </div>
        </header>

        <section class="mt-2">
            <article class="card-surface mb-2">
                @foreach ($verses as $item)
                    @if ($item->heading)
                        <div class="row flex-column flex-md-row m-0">
                            <div class="col-12 col-md-6 order-1 order-md-2">
                                <h6 class="text-justify notranslate fw-bold fs-5 m-0"
                                    style="line-height: 1.6; direction: rtl">
                                    {{ $item->heading }}
                                </h6>
                            </div>

                            <div class="col-12 col-md-6 order-2 order-md-1 m-0">
                                <h6 class="fw-bold fs-6 text-justify m-0">{{ $item->translation?->heading }}</h6>
                            </div>
                        </div>
                        <hr class="m-1">
                    @endif

                    <div class="row flex-column flex-md-row m-0 mb-1">
                        <div class="col-12 col-md-6 order-1 order-md-2">
                            <div class="text-justify notranslate text-hadith" style="font-size: 20px; line-height: 1.6;">
                                {{ $item->text }}
                                (<span class="fst-italic fs-6">{{ $verses->firstItem() + $loop->index }}</span>)
                            </div>
                        </div>

                        <div class="col-12 col-md-6 order-2 order-md-1">
                            <div class="text-en text-justify">{{ $item->translation?->text }}</div>
                        </div>
                    </div>

                    <p class="text-muted small notranslate fst-italic m-0">
                        🔖 {{ $chapter->book->translation?->name ?? $chapter->book->name }},
                        {{ __('app.volume') }}: {{ $item->volume }},
                        {{ __('app.chapter') }}: #{{ $chapter->translation?->name ?? $chapter->name }},
                        {{ __('app.hadith') }}: #{{ $item->hadith_number }},
                        {{ __('app.status') }}: {{ __('app.' . strtolower($item->status)) }}
                    </p>

                    @if (!$loop->last)
                        <div class="geo-divider my-2"></div>
                    @endif
                @endforeach
            </article>

            <div class="d-flex justify-content-center">
                {{ $verses->onEachSide(1)->links() }}
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'en,ml,hi',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>
@endpush
