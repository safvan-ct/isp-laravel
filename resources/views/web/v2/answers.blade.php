@extends('layouts.web-v2')

@section('content')
    <main class="container">
        <header class="page-hero">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('modules.show', 'life-of-muslim') }}">Topics</a></li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('questions.show', ['menu_slug' => 'wudu', 'module_slug' => 'namaz']) }}">
                            നബിദിനം
                        </a>
                    </li>
                </ol>
            </nav>

            <hr class="mt-1 mb-3">

            <div class="text-center">
                <h5 class="fw-bold text-primary text-Playfair text-ml">{{ array_keys($qst)[0] }}</h5>
                <p class="text-muted m-0">
                    ഖുർആൻ, ഹദീസ്, പ്രാമാണിക തെളിവുകൾ ഉൾക്കൊള്ളുന്ന പ്രായോഗിക ഘട്ടം ഘട്ടമായുള്ള മാർഗനിർദേശം.
                </p>
            </div>

            <div class="d-flex justify-content-between flex-column flex-md-row mt-2 d-none">
                <div>
                    <span class="tag fw-bold">Est. 12 min</span>
                    <span class="tag fw-bold">Difficulty: Easy</span>
                    <span class="tag fw-bold">Progress: 35%</span>
                </div>
                <div class="d-flex gap-2 mt-2 mt-md-0">
                    <button class="btn btn-outline-warning">☆ Bookmark</button>
                    <button class="btn btn-outline-secondary">✎ Note</button>
                </div>
            </div>
        </header>

        <div class="row g-2 my-1">
            <section class="col-lg-8">
                <article class="card-surface">
                    <h5 class="text-primary fw-bold mb-1">{{ array_keys($qst)[0] }}</h5>
                    <h6 class="text-arabic mb-2 d-none">خطوات الوضوء مع توضيح بالأشكال</h6>

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start">
                        <p class="text-muted small mb-0">
                            Author: Author Name • Reviewed • Verified
                        </p>

                        <p class="small text-muted mb-0">
                            Last review:
                            <time datetime="{{ now()->toDateString() }}">{{ now()->format('M d, Y') }}</time>
                            by <strong>Reviewer Name</strong>
                        </p>
                    </div>

                    <div class="mt-2 d-flex flex-wrap gap-2 d-none" aria-label="tags">
                        <span class="badge bg-secondary">Understand intention (niyyah)</span>
                        <span class="badge bg-secondary">Step order and minimal wipes</span>
                        <span class="badge bg-secondary">When tayammum is allowed</span>
                    </div>

                    <hr class="mt-3 mb-3">

                    @foreach (array_values($qst)[0] as $key => $item)
                        <div class="step-card mb-2">
                            <div class="num-card">{{ $key + 1 }}</div>
                            <div class="flex-1">
                                <div class="fw-bold">{{ $item }}</div>
                                <div class="small text-muted">Sincere intention before beginning — not aloud, internal.
                                </div>

                                <div class="d-flex flex-wrap gap-2 mt-2">
                                    @if ($key == 0)
                                        <button class="btn btn-sm btn-outline-secondary">
                                            Quran • S5:6
                                        </button>
                                    @endif

                                    @if ($key == 1)
                                        <button class="btn btn-sm btn-outline-secondary">
                                            Hadith • Bukhari 151
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="card mb-3 mt-3 shadow-sm">
                        <h5 class="fw-bold text-primary">Quick summary</h5>
                        <p class="mb-2">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Omnis exercitationem
                            inventore cum,
                            eius odio error et est ad! Commodi corrupti, a quasi accusamus voluptatem odit omnis ratione cum
                            voluptas natus.
                        </p>
                        <p class="mb-1">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Omnis exercitationem
                            inventore cum,
                            eius odio error et est ad! Commodi corrupti, a quasi accusamus voluptatem odit omnis ratione cum
                            voluptas natus.
                        </p>
                    </div>

                    <div class="card-surface mb-3">
                        <h6 class="fw-bold text-primary">Quran</h6>
                        <article class="mt-3">
                            <p class="text-arabic fw-bold mb-1 text-primary">
                                يَا أَيُّهَا الَّذِينَ آمَنُوا إِذَا قُمْتُمْ إِلَى الصَّلَاةِ فَاغْسِلُوا وُجُوهَكُمْ...
                            </p>

                            <p class="fst-italic mb-2">
                                “O you who believe! When you rise to prayer wash your faces…” — <em>S. 5:6</em>
                            </p>

                            <div class="text-end">
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                                    data-bs-target="#myLgModal">
                                    View verse
                                </button>
                            </div>
                        </article>
                        <hr class="mb-4 d-none">
                    </div>

                    <div class="card-surface p-2 mb-3">
                        <h6 class="fw-bold text-primary">Hadith</h6>

                        <article class="mt-2">
                            <div class="card-surface bg-light border">
                                <h6 class="text-primary fw-bold">Sahih al-Bukhari — Hadith 151</h6>

                                <p class="small text-muted mb-2">
                                    Short excerpt: The Prophet ﷺ instructed the sequence of washing during ablution.
                                </p>

                                <p class="small mb-0 text-muted">
                                    Grade: <strong class="text-body">Sahih</strong> •
                                    <button type="button" class="btn btn-link p-0 align-baseline" data-bs-toggle="modal"
                                        data-bs-target="#myLgModal">
                                        View full hadith
                                    </button>
                                </p>
                            </div>
                        </article>
                    </div>

                    <div class="card-surface">
                        <div class="row">
                            <h6 class="col-md-2 fw-bold text-primary">Video</h6>

                            <div class="col-md-10">
                                <div class="ratio ratio-16x9">
                                    <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" allowfullscreen></iframe>
                                </div>
                                <div class="text-muted small mt-2">
                                    Lecture: topic name and references
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 flex-wrap d-none">
                        <button class="btn btn-success rounded-5">Add to study plan</button>
                        <button class="btn btn-outline-secondary">Take quick quiz (3 items)</button>
                        <button class="btn btn-outline-success">Practice sketch (interactive)</button>
                        <button class="btn btn-outline-primary">View related questions</button>
                    </div>

                    <div class="text-muted d-none">
                        <strong>References</strong>
                    </div>
                </article>
            </section>

            <!-- SIDEBAR -->
            <aside class="col-lg-4 position-sticky d-flex flex-column align-self-start gap-2" style="top:84px;">
                <div class="card d-none d-md-block">
                    <h6 class="fw-bold text-primary">Quick summary</h6>
                    <p class="mb-2">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Omnis exercitationem
                        inventore cum,
                        eius odio error et est ad! Commodi corrupti, a quasi accusamus voluptatem odit omnis ratione cum
                        voluptas natus.
                    </p>
                    <p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Omnis exercitationem
                        inventore cum,
                        eius odio error et est ad! Commodi corrupti, a quasi accusamus voluptatem odit omnis ratione cum
                        voluptas natus.
                    </p>
                </div>

                <div class="card-surface d-none">
                    <h6 class="fw-bold text-primary">Trust & provenance</h6>
                    <div class="small text-muted">Editor: <strong>Editor Name</strong></div>
                    <div class="small text-muted">Verified: <strong>Yes</strong></div>
                    <div class="small text-muted">Last reviewed: <strong>{{ now()->format('M d, Y') }}</strong></div>

                    <div class="mt-2">
                        <button class="btn btn-outline-secondary btn-sm">View revision history</button>
                        <button class="btn btn-outline-success btn-sm">Copy citation</button>
                    </div>
                </div>

                <div class="card-surface">
                    <h6 class="fw-bold text-primary">Related subtopics</h6>
                    <ul class="small ps-3">
                        @foreach ($questions as $key => $item)
                            <li class="py-1">
                                <a class="text-primary"
                                    href="{{ route('answers.show', ['menu_slug' => 'festival', 'module_slug' => 'meelad', 'question_slug' => $key]) }}">
                                    {{ $item }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>
        </div>

        <article class="card-surface mt-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-primary fw-bold mb-0">നബിദിനം</h6>
                    <small class="d-block text-muted mt-1">
                        Asked by <strong>admin</strong> • {{ now()->format('M d, Y') }}
                    </small>
                </div>

                <button type="button" class="btn btn-outline-secondary btn-sm">
                    Share
                </button>
            </div>
        </article>
    </main>

    <div class="modal fade" id="myLgModal" tabindex="-1" aria-labelledby="myLgModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLgModalLabel">References</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body text-center">Reference Details</div>
            </div>
        </div>
    </div>
@endsection
