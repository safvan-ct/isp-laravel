@extends('layouts.app')

@section('content')
    <main class="container my-5">
        <header class="mt-5 pt-5">
            <section class="hero bg-geometry">
                <div class="text-center mx-auto">
                    <h1 class="mb-3 text-Playfair ls-1 text-tr">{{ __('app.seek_knowledge') }}</h1>

                    <div class="ayah-card  mb-4">
                        <h4 class="text-arabic d-flex flex-column flex-md-row justify-content-center align-items-center">
                            <span dir="rtl" class="mt-2">﴿ وَقُل رَّبِّ زِدْنِي عِلْمًا ﴾</span>
                            <span class="ms-md-2 mt-3 mt-md-2" style="opacity:.85;" dir="rtl">(طه ١١٤)</span>
                        </h4>
                    </div>

                    <p class="text-muted mb-4">
                        Quran, Hadith, calendar and subjects — organized for focused, distraction-free learning.
                    </p>

                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                        <a href="{{ route('quran.index') }}" class="btn btn-success rounded-pill px-4">
                            {{ __('app.explore_quran') }}
                        </a>
                        <a href="{{ route('hadith.index') }}" class="btn btn-accent rounded-pill px-4">
                            {{ __('app.explore_hadith') }}
                        </a>
                        <a href="{{ route('modules.show', 'life-of-muslim') }}" class="btn btn-secondary rounded-pill px-4">
                            {{ __('app.topics') }}
                        </a>
                    </div>
                </div>
            </section>
        </header>

        <!-- QUICK ACCESS CARDS -->
        <div class="row g-4 my-4 d-none">
            <div class="col-md-4">
                <x-app.feature-card :icon="'📖'" :title="'Quran'" :description="'All 114 surahs with verse navigation, translations and tafsir.'" :href="route('quran.index')" />
            </div>
            <div class="col-md-4">
                <x-app.feature-card :icon="'📚'" :title="'Hadith'" :description="'Browse books & chapters across authentic collections.'" :href="route('hadith.index')" />
            </div>
            <div class="col-md-4">
                <x-app.feature-card :icon="'📅'" :title="'Calendar'" :description="'Hijri/Gregorian view with notable Islamic events.'" :href="route('calendar')" />
            </div>
        </div>

        <!-- SUBJECTS -->
        <section class="my-3 d-none">
            <header class="text-center mb-4">
                <h2 class="text-Playfair text-primary text-tr">{{ __('app.foundational_subjects') }}</h2>
                <p class="text-muted">Build your base with structured chapters & Q/A</p>
            </header>

            <div class="row g-3 mb-3">
                @foreach ($modules->take(4) as $item)
                    <div class="col-sm-6 col-lg-3">
                        <a href="{{ route('questions.show', ['menu_slug' => $item->parent->slug, 'module_slug' => $item->slug]) }}"
                            class="text-decoration-none text-reset">
                            <x-app.subject-card :title="$item->translation?->title ?? $item->slug" :subTitle="$item->translation?->sub_title" />
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center">
                <a href="{{ route('modules.show', 'life-of-muslim') }}" class="btn btn-secondary rounded-1 px-4">
                    {{ __('app.see_more') }}
                </a>
            </div>
        </section>

        <!-- DIVIDER -->
        <div class="geo-divider my-4"></div>

        <!-- TOPICS -->
        <section class="my-4 d-none">
            <header class="text-center mb-4">
                <h2 class="text-Playfair text-primary text-tr">{{ __('app.explore_by_topics') }}</h2>
                <p class="text-muted">Quick access to common topics</p>
            </header>

            <div class="d-flex flex-wrap justify-content-center gap-2 mb-3">
                @foreach ($modules as $item)
                    <a href="{{ route('questions.show', ['menu_slug' => $item->parent->slug, 'module_slug' => $item->slug]) }}"
                        class="card-surface rounded-pill text-decoration-none text-primary feature-card">
                        {{ $item->translation?->title ?? $item->slug }}
                    </a>
                @endforeach
            </div>

            <div class="d-flex justify-content-center">
                <a href="{{ route('modules.show', 'life-of-muslim') }}" class="btn btn-secondary rounded-pill px-4">
                    {{ __('app.see_more') }}
                </a>
            </div>
        </section>
    </main>
@endsection
