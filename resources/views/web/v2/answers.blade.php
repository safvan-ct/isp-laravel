@extends('layouts.web-v2')

@section('content')
    <main class="container">
        <header class="page-hero">
            <h3 class="text-title fw-semibold">Topics</h3>
            <p class="small-note m-0">Browse subjects, preview top questions, and follow what matters for your study plan.
            </p>

            <div class="controls mt-3">
                <div class="input-group" style="min-width:320px;">
                    <span class="input-group-text">Sort</span>
                    <select id="sortSelect" class="form-select form-select-sm">
                        <option value="rank">Verified + Helpful</option>
                        <option value="helpful">Most Helpful</option>
                        <option value="newest">Newest</option>
                    </select>
                </div>

                <div class="form-check form-switch ms-2">
                    <input class="form-check-input" type="checkbox" />
                    <label class="form-check-label muted">Verified only</label>
                </div>

                <div class="ms-auto d-flex gap-2">
                    <button id="btnCompare" class="btn btn-outline-secondary btn-sm">Compare</button>
                    <button id="btnAddAnswer" class="btn btn-gold btn-sm">Add Answer</button>
                </div>
            </div>
        </header>

        <div class="row g-4 mt-1">
            <!-- main column -->
            <div class="col-lg-12">
                <div class="q-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="text-title fw-bold">{{ $question->translation?->title ?? $question->slug }}
                            </div>
                            <div class="small-note mt-1">
                                Asked by <strong>student1</strong> • 8/1/2025
                            </div>
                            <div class="small-note mt-2">
                                Tags: <span class="ref-pill">purity</span> <span class="ref-pill">wudu</span> <span
                                    class="ref-pill">practical</span>
                            </div>
                        </div>

                        <div class="d-flex gap-2 align-items-start">
                            <button class="btn btn-outline-warning btn-sm">☆</button>
                            <button class="btn btn-outline-secondary btn-sm">Share</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="flex-column">
                    @foreach ($question->children as $item)
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
            </div>
        </div>
    </main>
@endsection
