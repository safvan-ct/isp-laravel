@extends('layouts.web')

@section('content')
    <header class="header">
        <h1>{{ __('app.islamic_study_portal') }}</h1>
        <p>{{ __('app.home_sub_title') }}</p>
    </header>

    <main class="container my-3 flex-grow-1">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card section-card h-100 text-center d-flex flex-column justify-content-between">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-quran"></i> {{ __('app.quran_study') }}</h5>
                        <p class="card-text">{{ __('app.quran_sub_title') }}</p>
                    </div>

                    <div class="card-footer bg-transparent border-0 pb-0">
                        <a href="{{ route('quran.index') }}" class="btn btn-primary">{{ __('app.start_learning') }}</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card section-card h-100 text-center d-flex flex-column justify-content-between">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-book"></i> {{ __('app.hadith') }}</h5>
                        <p class="card-text">{{ __('app.hadith_sub_title') }}</p>
                    </div>

                    <div class="card-footer bg-transparent border-0 pb-0">
                        <a href="{{ route('hadith.index') }}" class="btn btn-primary">{{ __('app.view') }}</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card section-card h-100 text-center d-flex flex-column justify-content-between">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-calendar-alt"></i> {{ __('app.islamic_calendar') }}</h5>
                        <p class="card-text">{{ __('app.islamic_calendar_sub_title') }}</p>
                    </div>

                    <div class="card-footer bg-transparent border-0 pb-0">
                        <a href="{{ route('calendar') }}" class="btn btn-primary">{{ __('app.view_days') }}</a>
                    </div>
                </div>
            </div>

            @foreach ($modules as $item)
                <div class="col-md-4">
                    <div class="card section-card h-100 text-center d-flex flex-column justify-content-between">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->translation?->title ?: $item->slug }}</h5>
                            <p class="card-text">{!! $item->translation?->sub_title !!}</p>
                        </div>

                        <div class="card-footer bg-transparent border-0 pb-0">
                            <a href="{{ route('questions.show', ['menu_slug' => $item->parent->slug, 'module_slug' => $item->slug]) }}"
                                class="btn btn-primary">
                                {{ __('app.know_more') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection
