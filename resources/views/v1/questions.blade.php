@extends('layouts.app')

@push('styles')
@endpush

@section('content')
    <main class="container">
        <header class="page-hero">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('app.home') }}</a></li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('modules.show', 'life-of-muslim') }}">{{ __('app.topics') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">നബിദിനം</li>
                </ol>
            </nav>

            <hr class="mt-1 mb-3">

            <div class="text-center">
                <h5 class="fw-bold text-primary text-Playfair text-tr m-0">നബിദിനം - <small>അനുബന്ധ വിഷയങ്ങൾ</small></h5>
                <p class="text-muted m-0">നബിദിനം ആഘോഷിക്കേണ്ടതിന്റെ അടിസ്ഥാനവും ശ്രേഷ്ഠതയും</p>
            </div>

            <div class="text-center mx-auto mt-3">
                <div class="ayah-card">
                    <h6 class="text-arabic text-primary fw-bold mt-2 lh-lg mb-0">
                        ﴿ لاَ تُطْرُونِي كَمَا أَطْرَتِ النَّصَارَى ابْنَ مَرْيَمَ ﴾
                    </h6>

                    <p class="fst-italic small m-0">
                        ക്രിസ്ത്യാനികൾ മർയമിന്റെ മകനെ പുകഴ്ത്തിയതുപോലെ എന്നെ പുകഴ്ത്തുന്നതിൽ നിങ്ങൾ അതിശയോക്തി കാണിക്കരുത്
                    </p>

                    <p class="m-0 mt-1 text-muted small">(സഹീഹ് ബുഖാരി: 3445)</p>
                </div>
            </div>
        </header>

        <x-app.filter>
            <div class="row g-2 pb-2 bg-white shadow-sm rounded border align-items-center">
                <div class="col-12 col-md">
                    <input class="form-control form-control-sm" placeholder="Search topics, tags, or content"
                        id="search">
                </div>

                <div class="col-6 col-md-auto">
                    <select id="tagFilter" class="form-select form-select-sm">
                        <option value="all">All Subjects</option>
                    </select>
                </div>

                <div class="col-6 col-md-auto">
                    <select id="answeredFilter" class="form-select form-select-sm">
                        <option value="all">All</option>
                        <option value="answered">Answered</option>
                        <option value="unanswered">Unanswered</option>
                    </select>
                </div>

                <div class="col-6 col-md-auto">
                    <select id="sortSelect" class="form-select form-select-sm">
                        <option value="best">Best (verified + helpful)</option>
                        <option value="newest">Newest</option>
                        <option value="helpful">Most helpful</option>
                    </select>
                </div>

                <div class="col-12 col-md-auto ms-md-auto d-flex gap-2 justify-content-end">
                    <button class="btn btn-warning btn-sm rounded-pill">Ask Query</button>
                    <button class="btn btn-outline-secondary btn-sm">Bookmarks</button>
                </div>
            </div>
        </x-app.filter>

        <section class="mt-3">
            <div class="row g-2">
                @foreach ($questions as $key => $item)
                    @php
                        // safe extraction whether $item is object or plain string
                        $title = is_object($item) ? $item->title ?? ($item->question ?? 'Untitled') : $item;
                        $addedAt = is_object($item) && isset($item->created_at) ? $item->created_at : now();
                        $tags =
                            is_object($item) && isset($item->tags)
                                ? $item->tags
                                : ['festival', 'birthday', 'prophet', 'meelad'];
                        $answersCount = is_object($item) && isset($item->answers_count) ? $item->answers_count : 2;
                    @endphp

                    <div class="col-12 col-md-4">
                        <article class="card h-100 d-flex flex-column p-3">
                            <h6 class="text-primary fw-bold mb-2">{{ $loop->iteration }} : {{ $title }}</h6>

                            <p class="small text-muted mb-2">
                                <span>Added • </span>
                                <time datetime="{{ \Carbon\Carbon::parse($addedAt)->toDateString() }}">
                                    {{ \Carbon\Carbon::parse($addedAt)->format('d-m-Y') }}
                                </time>
                                <span>•</span>
                                <span>{{ $answersCount }} answers</span>
                            </p>

                            <div class="mb-2">
                                @foreach ($tags as $tag)
                                    <span class="badge rounded-pill bg-light text-dark border">{{ $tag }}</span>
                                @endforeach
                            </div>

                            <div class="mt-auto d-flex gap-2 justify-content-end">
                                <a href="{{ route('answers.show', ['menu_slug' => 'festival', 'module_slug' => 'meelad', 'question_slug' => $key]) }}"
                                    class="btn btn-sm btn-outline-success"
                                    aria-label="Open question {{ $loop->iteration }}">
                                    Open
                                </a>

                                <button type="button" class="btn btn-sm btn-outline-secondary"
                                    aria-label="Share question {{ $loop->iteration }}">
                                    Share
                                </button>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </section>

        <button type="button" class="btn btn-secondary rounded-pill position-fixed bottom-0 end-0 me-3 mb-2 z-3"
            data-bs-toggle="modal" data-bs-target="#quranHadithModal">
            <i class="fas fa-book text-white"></i>
        </button>
    </main>
@endsection
