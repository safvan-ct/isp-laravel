@extends('layouts.web-v2')

@section('content')
    <main class="container">
        <header class="page-hero">
            <h3 class="text-title fw-semibold">Topics</h3>
            <p class="small-note m-0">
                Browse subjects, preview top questions, and follow what matters for your study plan.
            </p>
        </header>

        <x-app.filter>
            <div
                class="d-flex flex-wrap align-items-center justify-content-between gap-2 p-2 bg-white shadow-sm rounded-3 border">
                <div class="control w-sm-100" style="width: 40%">
                    <input id="searchInput" class="form-control" placeholder="Search topics, tags, or content">
                </div>

                <div class="control-sm">
                    <label class="visually-hidden" for="tagFilter">Tag</label>
                    <select id="tagFilter" class="form-select form-select-sm">
                        <option value="all">All Subjects</option>
                    </select>
                </div>

                <div class="control-sm">
                    <label class="visually-hidden" for="answeredFilter">Answered</label>
                    <select id="answeredFilter" class="form-select form-select-sm">
                        <option value="all">All</option>
                        <option value="answered">Answered</option>
                        <option value="unanswered">Unanswered</option>
                    </select>
                </div>

                <div class="control-sm">
                    <label class="visually-hidden" for="sortSelect">Sort</label>
                    <select id="sortSelect" class="form-select form-select-sm">
                        <option value="best">Best (verified + helpful)</option>
                        <option value="newest">Newest</option>
                        <option value="helpful">Most helpful</option>
                    </select>
                </div>

                <div class="ms-auto d-flex gap-2">
                    <button class="btn btn-sm btn-warning rounded-5">Ask question</button>
                    <button class="btn btn-outline-secondary btn-sm">Bookmarks</button>
                </div>
            </div>
        </x-app.filter>

        <section class="mt-3">
            <div class="q-list row g-1" aria-live="polite">
                @foreach ($module->children as $item)
                    <div class="col-12 col-md-4">
                        <article class="q-card d-flex flex-column h-100">
                            <div class="text-primary fw-bold">
                                {{ $item->translation?->title ?? $item->slug }}
                            </div>

                            <div class="small-note d-flex flex-wrap gap-2 mt-1">
                                <div>Asked • 8/1/2025</div>
                                <div>•</div>
                                <div>2 answers</div>
                            </div>

                            <div class="mt-2 mb-2">
                                <button class="ref-pill small-note">purity</button>
                                <button class="ref-pill small-note">wudu</button>
                                <button class="ref-pill small-note">practical</button>
                            </div>

                            <div class="actions mt-auto d-flex gap-2">
                                <a href="{{ route('answers.show', ['menu_slug' => $module->parent->slug, 'module_slug' => $module->slug, 'question_slug' => $item->slug]) }}"
                                    class="btn btn-sm btn-outline-success" role="button">
                                    Open
                                </a>
                                <button class="btn btn-sm btn-outline-secondary">Share</button>
                                <button class="btn btn-sm btn-outline-warning">★</button>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
@endsection
