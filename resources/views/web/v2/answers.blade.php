@extends('layouts.web-v2')

@section('content')
    <main class="container">
        <header class="page-hero-1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('modules.show', 'life-of-muslim') }}">Topics</a></li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('questions.show', ['menu_slug' => 'wudu', 'module_slug' => 'namaz']) }}">
                            നബിദിനം
                        </a>
                    </li>
                </ol>
            </nav>
            <hr class="mt-2 mb-3">

            <div class="d-flex align-items-center justify-content-between flex-column flex-md-row">
                <div>
                    <h5 class="text-title d-none">{{ array_keys($qst)[0] }}</h5>
                    <div class="text-muted">
                        ഖുർആൻ, ഹദീസ്, പ്രാമാണിക തെളിവുകൾ, എന്നിവ ഉൾക്കൊള്ളുന്ന പ്രായോഗിക ഘട്ടം ഘട്ടമായുള്ള
                        മാർഗനിർദേശം.
                    </div>

                    <div class="mt-2 d-none">
                        <span class="tag text-primary fw-bold">Est. 12 min</span>
                        <span class="tag text-primary fw-bold">Difficulty: Easy</span>
                        <span class="tag text-primary fw-bold">Progress: 35%</span>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2 mt-2 d-none">
                    <button class="btn btn-outline-warning">☆ Bookmark</button>
                    <button class="btn btn-outline-secondary">✎ Note</button>
                    <button class="btn btn-accent">Export</button>
                </div>
            </div>
        </header>

        <div class="row g-4 my-1">
            <section class="col-lg-8">
                <article class="card-surface">
                    <h5 class="text-title mb-2">{{ array_keys($qst)[0] }}</h5>

                    <div class="d-flex justify-content-between flex-column flex-md-row">
                        <div class="d-flex">
                            <h6 class="text-arabic d-none">خطوات الوضوء مع توضيح بالأشكال</h6>
                            <p class="text-muted small m-0">
                                Author: Author Name • Reviewed • Verified
                            </p>
                        </div>

                        <div class="small text-muted">
                            Last review: {{ now()->format('M d, Y') }} by <strong> Reviewer Name</strong>
                        </div>
                    </div>

                    <!-- Tags -->
                    <div class="mt-3 d-none">
                        <div class="tag mb-1">Understand intention (niyyah)</div>
                        <div class="tag mb-1">Step order and minimal wipes</div>
                        <div class="tag mb-1">When tayammum is allowed</div>
                    </div>
                    <hr class="mt-2 mb-3">

                    <!-- Steps -->
                    <div class="mb-3 mt-2">
                        @foreach (array_values($qst)[0] as $key => $item)
                            <div class="step mb-2">
                                <div class="num">{{ $key + 1 }}</div>
                                <div class="step-body">
                                    <div class="fw-bold">{{ $item }}</div>
                                    <div class="small muted">Sincere intention before beginning — not aloud, internal.</div>

                                    <div class="refs">
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
                    </div>

                    <div class="card-surface mb-3">
                        <div class="fw-bold">Quick summary</div>
                        <p class="text-muted">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Omnis exercitationem
                            inventore cum,
                            eius odio error et est ad! Commodi corrupti, a quasi accusamus voluptatem odit omnis ratione cum
                            voluptas natus.
                        </p>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Omnis exercitationem inventore cum,
                            eius odio error et est ad! Commodi corrupti, a quasi accusamus voluptatem odit omnis ratione cum
                            voluptas natus.
                        </p>
                    </div>

                    <!-- Quran -->
                    <div class="align-items-start border p-3 mb-3 rounded">
                        <div class="row">
                            <!-- Evidence type -->
                            <div class="col-md-12 fw-bold text-primary mb-2">
                                Quran
                            </div>

                            <!-- Verse content -->
                            <div class="col-md-12 mb-3">
                                <div class="mb-2">
                                    <div class="text-arabic text-primary fw-bold">
                                        يَا أَيُّهَا الَّذِينَ آمَنُوا إِذَا قُمْتُمْ إِلَى الصَّلَاةِ فَاغْسِلُوا
                                        وُجُوهَكُمْ...
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <div class="fst-italic">
                                        “O you who believe! When you rise to prayer wash your faces…” — <em>S. 5:6</em>
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <button class="btn btn-sm btn-outline-secondary me-2" data-bs-toggle="modal"
                                        data-bs-target="#myLgModal">
                                        View verse
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-2">
                                    <div class="text-arabic text-primary fw-bold">
                                        يَا أَيُّهَا الَّذِينَ آمَنُوا إِذَا قُمْتُمْ إِلَى الصَّلَاةِ فَاغْسِلُوا
                                        وُجُوهَكُمْ...
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <div class="fst-italic">
                                        “O you who believe! When you rise to prayer wash your faces…” — <em>S. 5:6</em>
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <button class="btn btn-sm btn-outline-secondary me-2" data-bs-toggle="modal"
                                        data-bs-target="#myLgModal">
                                        View verse
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="align-items-start border p-3 mb-3 rounded">
                        <div class="row">
                            <!-- Evidence type -->
                            <div class="col-md-12 fw-bold text-primary">
                                Hadith
                            </div>

                            <!-- Hadith content -->
                            <div class="col-md-12 mb-2">
                                <div class="card-surface shadow-sm border-2">
                                    <h6 class="card-title fw-bold mb-2">Sahih al-Bukhari — Hadith 151</h6>
                                    <p class="card-text text-muted small mb-2">
                                        Short excerpt: The Prophet ﷺ instructed the sequence of washing during ablution.
                                    </p>
                                    <p class="text-muted small mb-0">
                                        Grade: <strong>Sahih</strong> •
                                        <a role="button" class="btn btn-link p-0" data-bs-toggle="modal"
                                            data-bs-target="#myLgModal">
                                            View full hadith
                                        </a>
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-12 mb-2">
                                <div class="card-surface shadow-sm border-2">
                                    <h6 class="card-title fw-bold mb-2">Sahih al-Bukhari — Hadith 151</h6>
                                    <p class="card-text text-muted small mb-2">
                                        Short excerpt: The Prophet ﷺ instructed the sequence of washing during ablution.
                                    </p>
                                    <p class="text-muted small mb-0">
                                        Grade: <strong>Sahih</strong> •
                                        <a role="button" class="btn btn-link p-0" data-bs-toggle="modal"
                                            data-bs-target="#myLgModal">
                                            View full hadith
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="align-items-start border p-3 mb-3 rounded">
                        <div class="row">
                            <!-- Evidence type -->
                            <div class="col-md-2 fw-bold text-primary">
                                Video
                            </div>

                            <!-- Video content -->
                            <div class="col-md-10">
                                <div class="ratio ratio-16x9">
                                    <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="lecture" allowfullscreen>
                                    </iframe>
                                </div>
                                <div class="text-muted small mt-2">
                                    Lecture: topic name and references
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Related Qs + Activities -->
                    <div class="d-flex gap-2 flex-wrap d-none">
                        <button class="btn btn-success rounded-5">Add to study plan</button>
                        <button class="btn btn-outline-secondary">Take quick quiz (3 items)</button>
                        <button class="btn btn-outline-success">Practice sketch (interactive)</button>
                        <button class="btn btn-outline-primary">View related questions</button>
                    </div>

                    <!-- footnotes & references summary -->
                    <div class="text-muted d-none">
                        <strong>References</strong>
                    </div>
                </article>
            </section>

            <!-- SIDEBAR -->
            <aside class="sidebar col-lg-4">
                <div class="card-surface d-none d-md-block">
                    <div class="fw-bold">Quick summary</div>
                    <p class="text-muted">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Omnis exercitationem
                        inventore cum,
                        eius odio error et est ad! Commodi corrupti, a quasi accusamus voluptatem odit omnis ratione cum
                        voluptas natus.
                    </p>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Omnis exercitationem inventore cum,
                        eius odio error et est ad! Commodi corrupti, a quasi accusamus voluptatem odit omnis ratione cum
                        voluptas natus.
                    </p>
                </div>

                <div class="card-surface d-none">
                    <div class="fw-bold">Recitation</div>
                    <div class="small muted">Select reciter</div>
                    <select id="reciterSelect" class="form-select form-select-sm mb-2">
                        <option value="rec1">Saad Al-Ghamdi</option>
                        <option value="rec2">Mishary Alafasy</option>
                    </select>
                    <audio id="reciterPlayer" controls preload="none" style="width:100%"
                        src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3"></audio>
                </div>

                <div class="card-surface d-none">
                    <div class="fw-bold">Trust & provenance</div>
                    <div class="small muted mt-1">Editor: <strong>Editor Name</strong></div>
                    <div class="small muted">Verified: <strong>Yes</strong></div>
                    <div class="small muted">Last reviewed: <strong>{{ now()->format('M d, Y') }}</strong></div>

                    <div style="mt-2">
                        <button class="btn btn-outline-secondary btn-sm">View revision history</button>
                        <button class="btn btn-outline-success btn-sm">Copy citation</button>
                    </div>
                </div>

                <div class="card-surface">
                    <div class="fw-bold">Related subtopics</div>
                    <ul class="small ps-3 mt-1">
                        @foreach ($questions as $key => $item)
                            <li class="py-1">
                                <a
                                    href="{{ route('answers.show', ['menu_slug' => 'festival', 'module_slug' => 'meelad', 'question_slug' => $key]) }}">
                                    {{ $item }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>
        </div>

        <div class="row g-4">
            <!-- main column -->
            <div class="col-lg-12">
                <div class="card-surface">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="text-title fw-bold">നബിദിനം</h5>
                            <div class="small-note mt-1">
                                Asked by <strong>admin</strong> • {{ now()->format('M d, Y') }}
                            </div>
                        </div>

                        <div class="d-flex gap-2 align-items-start">
                            <button class="btn btn-outline-secondary btn-sm">Share</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
