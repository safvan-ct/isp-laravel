@extends('layouts.web-v2')

@section('content')
    <main class="container">
        <header class="page-hero">
            <h3 class="text-title fw-semibold">Subjects</h3>
            <p class="small-note m-0">Browse subjects, preview top questions, and follow what matters for your study plan.
            </p>
        </header>

        <x-app.filter>
            <div
                class="d-flex flex-wrap align-items-center justify-content-between gap-2 p-2 bg-white shadow-sm rounded-3 border">
                <div class="control w-50 w-sm-100">
                    <input id="searchInput" class="form-control"
                        placeholder="Search subjects, tags, or keywords (e.g. 'wudu', 'seerah')">
                </div>

                <div class="control-sm">
                    <label class="visually-hidden" for="tagFilter">Tag</label>
                    <select id="tagFilter" class="form-select form-select-sm">
                        <option value="all">All tags</option>
                    </select>
                </div>

                <div class="control-sm">
                    <label class="visually-hidden" for="sortSelect">Sort</label>
                    <select id="sortSelect" class="form-select form-select-sm">
                        <option value="featured">Featured</option>
                        <option value="most_questions">Most questions</option>
                        <option value="recent">Recently updated</option>
                        <option value="answered_pct">Highest answered %</option>
                    </select>
                </div>
            </div>
        </x-app.filter>

        <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
            <div class="small-note">Showing <span>{{ $topic->children->count() }}</span> subjects</div>
            <div class="small-note muted">
                Followed
                <strong>{{ $topic->children->where('is_primary', true)->count() }}</strong>
            </div>
        </div>

        <section id="subjectsSection">
            <div id="grid" class=" row g-2" role="list" aria-label="Subjects list">
                @foreach ($topic->children as $item)
                    <div class="col-12 col-md-4">
                        <article class="subject-card d-flex flex-column h-100" role="article" tabindex="0">
                            <div class="d-flex align-items-center gap-4">
                                <div class="subject-icon" aria-hidden="true">ال</div>
                                <div class="flex-grow-1">
                                    <div class="text-primary fw-bold">{{ $item->translation?->title ?: $item->slug }}</div>
                                    <div class="small-note">{!! $item->translation?->sub_title !!}</div>
                                </div>
                            </div>

                            <div class="featured-qa my-3">
                                <div class="feat-q">
                                    {!! $item->translation?->content !!}
                                </div>
                            </div>

                            <div class="subject-stats d-flex align-items-center flex-wrap gap-2 mt-auto">
                                <div class="stat-pill">312 Q</div>
                                <div class="stat-pill">93% answered</div>
                                <div class="stat-pill">Updated 7/18/2025</div>
                                <div class="ms-auto d-flex">
                                    <button class="btn btn-sm follow-btn">Follow</button>

                                    <a class="btn btn-sm btn-outline-success ms-2"
                                        href="{{ route('questions.show', ['menu_slug' => $topic->slug, 'module_slug' => $item->slug]) }}"
                                        role="button">
                                        Open
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
@endsection
