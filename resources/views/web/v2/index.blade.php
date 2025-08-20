@extends('layouts.web-v2')

@section('content')
    <!-- HEADER / HERO -->
    <x-app.home-hero :title="'Seek Knowledge with Ease'" :ayah="'﴿ وَقُل رَّبِّ زِدْنِي عِلْمًا ﴾'" :surah="'(طه ١١٤)'" :description="'Quran, Hadith, calendar and subjects — organized for focused, distraction-free learning.'" :buttons="[
        ['label' => 'Explore Quran', 'url' => route('quran.index'), 'color' => 'emerald'],
        ['label' => 'Explore Hadith', 'url' => route('hadith.index'), 'color' => 'gold'],
    ]" />

    <!-- QUICK ACCESS CARDS -->
    <main class="container my-5">
        <div class="row g-4">
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
    </main>

    <!-- DIVIDER -->
    <x-app.geo-divider />

    <!-- SUBJECTS -->
    <section class="container my-3">
        <x-app.section-header :title="'Foundational Subjects'" :description="'Build your base with structured chapters & Q/A'" />

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
    <section class="container my-4">
        <x-app.section-header :title="'Explore by Topics'" :description="'Quick access to common questions'" />

        <div class="d-flex flex-wrap justify-content-center">
            @foreach ($modules as $item)
                <a href="{{ route('questions.show', ['menu_slug' => $item->parent->slug, 'module_slug' => $item->slug]) }}"
                    class="topic-chip text-decoration-none">
                    {{ $item->translation?->title ?? $item->slug }}
                </a>
            @endforeach
        </div>
    </section>
@endsection
