@extends('layouts.web-v2')

@push('styles')
@endpush

@section('content')
    <main class="container">
        <header class="page-hero-1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('modules.show', 'life-of-muslim') }}">Topics</a></li>
                    <li class="breadcrumb-item active" aria-current="page">നബിദിനം</li>
                </ol>
            </nav>
            <hr class="mt-2 mb-3">

            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h5 class="text-title mb-2">നബിദിനം - <small>അനുബന്ധ വിഷയങ്ങൾ</small></h5>
                    <p class="text-muted m-0">നബിദിനം ആഘോഷിക്കേണ്ടതിന്റെ അടിസ്ഥാനവും ശ്രേഷ്ഠതയും</p>
                </div>
                <div class="d-flex align-items-center gap-2 d-none">
                    <span class="tag text-primary fw-bold">Topic: നബി ദിനം</span>

                    <button class="btn btn-outline-success btn-sm filters-mobile-btn d-lg-none" data-bs-toggle="offcanvas"
                        data-bs-target="#filtersCanvas">Filters</button>
                </div>
            </div>
        </header>

        <x-app.filter>
            <div
                class="d-flex flex-wrap align-items-center justify-content-between gap-2 p-2 bg-white shadow-sm rounded-3 border">
                <div class="control w-sm-100" style="width: 40%">
                    <input class="form-control form-control-sm" placeholder="Search topics, tags, or content">
                </div>

                <div class="control-sm">
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
                @foreach ($questions as $key => $item)
                    <div class="col-12 col-md-4">
                        <article class="q-card d-flex flex-column h-100">
                            <div class="text-primary fw-bold">
                                {{ $key + 1 }} • {{ $item }}
                            </div>

                            <div class="small-note d-flex flex-wrap gap-2 mt-1">
                                <div>Added • {{ date('d-m-Y') }}</div>
                                {{-- <div>•</div>
                                <div>2 answers</div> --}}
                            </div>

                            <div class="mt-2 mb-2">
                                <button class="ref-pill small-note">festival</button>
                                <button class="ref-pill small-note">birthday</button>
                                <button class="ref-pill small-note">prophet</button>
                                <button class="ref-pill small-note">meelad</button>
                            </div>

                            <div class="actions mt-auto d-flex gap-2">
                                <a href="{{ route('answers.show', ['menu_slug' => 'festival', 'module_slug' => 'meelad', 'question_slug' => $key]) }}"
                                    class="btn btn-sm btn-outline-success" role="button">
                                    Open
                                </a>
                                <button class="btn btn-sm btn-outline-secondary">Share</button>
                                <button class="btn btn-sm btn-outline-warning d-none">★</button>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
@endsection
