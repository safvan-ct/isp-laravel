@extends('layouts.web-v2')

@section('content')
    <!-- HEADER / HERO -->
    <main class="container my-5">
        <header class="mt-5 pt-5">
            <section class="hero bg-geometry">
                <div class="text-center mx-auto">
                    <h1 class="display-5 mb-3 text-Playfair ls-1">Seek Knowledge with Ease</h1>
                    <h4 class="ayah text-arabic mb-4" style="direction: ltr">
                        <span class="ms-2" style="opacity:.85;" dir="rtl">(طه ١١٤)</span>
                        <span dir="rtl">﴿ وَقُل رَّبِّ زِدْنِي عِلْمًا ﴾</span>
                    </h4>

                    <p class="text-muted mb-4">
                        Quran, Hadith, calendar and subjects — organized for focused, distraction-free learning.
                    </p>

                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                        <a href="{{ route('quran.index') }}" class="btn btn-success rounded-pill btn-cta px-4">
                            Explore Quran
                        </a>
                        <a href="{{ route('hadith.index') }}" class="btn btn-accent rounded-pill btn-cta px-4">
                            Explore Hadith
                        </a>
                    </div>
                </div>
            </section>
        </header>

        <!-- QUICK ACCESS CARDS -->
        <div class="row g-4 my-4">
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

        <!-- DIVIDER -->
        <div class="geo-divider my-4"></div>

        <!-- SUBJECTS -->
        <section class="my-3">
            <header class="text-center mb-4">
                <h2 class="text-Playfair text-primary">Foundational Subjects</h2>
                <p class="text-muted">Build your base with structured chapters & Q/A</p>
            </header>

            <div class="row g-3">
                @foreach ($modules as $item)
                    <div class="col-sm-6 col-lg-3">
                        <a href="{{ route('questions.show', ['menu_slug' => $item->parent->slug, 'module_slug' => $item->slug]) }}"
                            class="text-decoration-none text-reset">
                            <x-app.subject-card :title="$item->translation?->title ?? $item->slug" :subTitle="$item->translation?->sub_title" />
                        </a>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- TOPICS -->
        <section class="my-4">
            <header class="text-center mb-4">
                <h2 class="text-Playfair text-primary">Explore by Topics</h2>
                <p class="text-muted">Quick access to common questions</p>
            </header>

            <div class="d-flex flex-wrap justify-content-center gap-2">
                @foreach ($modules as $item)
                    <a href="{{ route('questions.show', ['menu_slug' => $item->parent->slug, 'module_slug' => $item->slug]) }}"
                        class="card-surface rounded-pill text-decoration-none text-primary feature-card">
                        {{ $item->translation?->title ?? $item->slug }}
                    </a>
                @endforeach
            </div>
        </section>
    </main>
@endsection
