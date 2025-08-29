@extends('layouts.web-v2')

@section('content')
    <main class="container">
        <header class="page-hero-1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Topics</a></li>
                    <li class="breadcrumb-item active" aria-current="page">നബി ദിനം (റ. അവ്വൽ 12)</li>
                </ol>
            </nav>

            <div class="d-flex align-items-center justify-content-between flex-column flex-md-row">
                <div>
                    <h5 class="text-title d-none">{{ array_keys($qst)[0] }}</h5>
                    <div class="text-muted">
                        Practical step-by-step guide with canonical evidence, tafsir context and hadith support.
                    </div>

                    <div class="mt-2">
                        <span class="tag text-primary fw-bold">Est. 12 min</span>
                        <span class="tag text-primary fw-bold">Difficulty: Easy</span>
                        <span class="tag text-primary fw-bold">Progress: 35%</span>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2 mt-2">
                    <button class="btn btn-outline-warning">☆ Bookmark</button>
                    <button class="btn btn-outline-secondary">✎ Note</button>
                    <button class="btn btn-accent">Export</button>
                </div>
            </div>
        </header>

        <div class="row g-4 mt-1">
            <section class="col-lg-8">
                <article class="card-surface">
                    <h5 class="text-title mb-2">{{ array_keys($qst)[0] }}</h5>

                    <div class="d-flex justify-content-between gap-2 flex-column flex-md-row">
                        <div class="d-flex gap-2">
                            <h6 class="text-arabic d-none">خطوات الوضوء مع توضيح بالأشكال</h6>
                            <p class="text-muted small">
                                Author: Scholar Ahmad • Reviewed • Verified
                            </p>
                        </div>

                        <div class="small muted">
                            Last review: Aug 05, 2025 by <strong>Dr. Salma</strong>
                        </div>
                    </div>

                    <!-- Tags -->
                    <div class="mt-3 d-none">
                        <div class="tag mb-1">Understand intention (niyyah)</div>
                        <div class="tag mb-1">Step order and minimal wipes</div>
                        <div class="tag mb-1">When tayammum is allowed</div>
                    </div>
                    <hr class="m-0">

                    <!-- Steps -->
                    <div class="mb-3 mt-2">
                        @foreach (array_values($qst)[0] as $key => $item)
                            <div class="step mb-2">
                                <div class="num">{{ $key + 1 }}</div>
                                <div class="step-body">
                                    <div class="fw-bold">{{ $item }}</div>
                                    <div class="small muted">Sincere intention before beginning — not aloud, internal.</div>
                                    <div class="refs d-none">
                                        <button class="btn btn-sm btn-outline-secondary">
                                            Quran • S5:6
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary">
                                            Hadith • Bukhari 151
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Sketch / diagram -->
                    <div class="card-surface p-2 mb-3">
                        <h5>Overview</h5>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Omnis exercitationem inventore cum,
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
                            <div class="col-md-2 fw-bold text-primary">
                                Quran
                            </div>

                            <!-- Verse content -->
                            <div class="col-md-10">
                                <div class="mb-2">
                                    <div class="text-arabic">
                                        يَا أَيُّهَا الَّذِينَ آمَنُوا إِذَا قُمْتُمْ إِلَى الصَّلَاةِ فَاغْسِلُوا
                                        وُجُوهَكُمْ...
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <div class="fst-italic">
                                        “O you who believe! When you rise to prayer wash your faces…” — <em>S. 5:6</em>
                                    </div>
                                </div>

                                <!-- Action buttons -->
                                <div class="mt-2">
                                    <button class="btn btn-sm btn-outline-secondary me-2">View verse</button>
                                    <button class="btn btn-sm btn-outline-success">Play recitation</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="align-items-start border p-3 mb-3 rounded">
                        <div class="row">
                            <!-- Evidence type -->
                            <div class="col-md-2 fw-bold text-primary">
                                Hadith
                            </div>

                            <!-- Hadith content -->
                            <div class="col-md-10">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body">
                                        <h6 class="card-title fw-bold mb-2">Sahih al-Bukhari — Hadith 151</h6>
                                        <p class="card-text text-muted small mb-2">
                                            Short excerpt: The Prophet ﷺ instructed the sequence of washing during ablution.
                                        </p>
                                        <p class="text-muted small mb-0">
                                            Grade: <strong>Sahih</strong> •
                                            <button class="btn btn-link p-0">View full isnād &amp; text</button>
                                        </p>
                                    </div>
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
                                <div class="w-100">
                                    <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="lecture" allowfullscreen>
                                    </iframe>
                                </div>
                                <div class="text-muted small mt-2">
                                    Lecture: Practical Wudu — starts at 00:30 with steps demonstration.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Related Qs + Activities -->
                    <div class="d-flex gap-2 flex-wrap">
                        <button class="btn btn-success rounded-5">Add to study plan</button>
                        <button class="btn btn-outline-secondary">Take quick quiz (3 items)</button>
                        <button class="btn btn-outline-success">Practice sketch (interactive)</button>
                        <button class="btn btn-outline-primary">View related questions</button>
                    </div>

                    <!-- footnotes & references summary -->
                    <div class="text-muted">
                        <strong>References</strong>
                    </div>
                </article>
            </section>

            <!-- SIDEBAR -->
            <aside class="sidebar col-lg-4">
                <div class="card-surface">
                    <div class="fw-bold">Quick evidence summary</div>
                    <div class="small muted">Tap any item to open full source viewer</div>
                </div>

                <div class="card-surface">
                    <div class="fw-bold">Recitation</div>
                    <div class="small muted">Select reciter</div>
                    <select id="reciterSelect" class="form-select form-select-sm mb-2">
                        <option value="rec1">Saad Al-Ghamdi</option>
                        <option value="rec2">Mishary Alafasy</option>
                    </select>
                    <audio id="reciterPlayer" controls preload="none" style="width:100%"
                        src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3"></audio>
                </div>

                <div class="card-surface">
                    <div class="fw-bold">Trust & provenance</div>
                    <div class="small muted mt-1">Editor: <strong>Dr. Salma</strong></div>
                    <div class="small muted">Verified: <strong>Yes</strong></div>
                    <div class="small muted">Last reviewed: <strong>Aug 05, 2025</strong></div>
                    <div style="margin-top:8px;">
                        <button class="btn btn-outline-secondary btn-sm" id="btnHistory">View revision history</button>
                        <button class="btn btn-outline-success btn-sm" id="btnCite">Copy citation</button>
                    </div>
                </div>

                <div class="card-surface">
                    <div class="fw-bold">Related subtopics</div>
                    <ul class="small" style="padding-left:18px; margin-top:8px;">
                        <li><a href="#">Tayammum — when & how</a></li>
                        <li><a href="#">Wiping over socks (khuffs)</a></li>
                        <li><a href="#">Wudu for medical cases</a></li>
                    </ul>
                </div>
            </aside>
        </div>

        <div class="row g-4 mt-1">
            <!-- main column -->
            <div class="col-lg-12">
                <div class="q-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="text-title fw-bold">{{ $question?->translation?->title ?? $question?->slug }}
                            </div>
                            <div class="small-note mt-1">
                                Asked by <strong>student1</strong> • 8/1/2025
                            </div>
                            {{-- <div class="small-note mt-2">
                                Tags: <span class="ref-pill">purity</span> <span class="ref-pill">wudu</span> <span
                                    class="ref-pill">practical</span>
                            </div> --}}
                        </div>

                        <div class="d-flex gap-2 align-items-start">
                            <button class="btn btn-outline-warning btn-sm">☆</button>
                            <button class="btn btn-outline-secondary btn-sm">Share</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="col-lg-8">
                <div class="flex-column">
                    @foreach ($question?->children ?? [] as $item)
                        <div class="answer-card mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="text-primary fw-bold">{{ $item->translation?->title ?? $item->slug }}</div>
                                <div class="small-note">8/2/2025</div>
                            </div>

                            <div class="mt-1">{!! $item->translation?->content !!}</div>

                            <div class="d-flex align-items-center mt-2 gap-2 muted">
                                <div>Helpful: <strong id="help-a-1">24</strong></div>
                                <div>•</div>
                                <div class="ref-badges">
                                    <button class="ref-pill" data-ans="a-1" data-idx="0">QURAN • S5:6</button>
                                    <button class="ref-pill" data-ans="a-1" data-idx="1">HADITH • bukhari</button>
                                </div>
                            </div>

                            <div class="actions">
                                <button class="btn btn-sm btn-outline-success">Helpful</button>
                                <button class="btn btn-sm btn-outline-warning">☆ Save</button>
                                <button class="btn btn-sm btn-outline-primary">Open refs</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- sidebar -->
            <div class="col-lg-4">
                <aside class="sidebar">
                    <div class="panel">
                        <h6 class="text-primary fw-semibold">Quick references</h6>
                        <div class="muted small">
                            All references used across visible answers will appear here for quick access.
                        </div>
                        <div class="mt-2 d-flex gap-2 flex-column">
                            <button class="ref-pill" type="button">QURAN • S5:6</button>
                            <button class="ref-pill" type="button">HADITH • bukhari</button>
                            <button class="ref-pill" type="button">VIDEO</button>
                            <button class="ref-pill" type="button">HADITH • muslim</button>
                        </div>
                    </div>
                </aside>
            </div> --}}
        </div>
    </main>
@endsection
