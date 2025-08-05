@extends('layouts.web')

@section('content')
    <header class="header">
        <h1>{{ __('Islamic Study Portal') }}</h1>
        <p>{{ __('You can study Islamic education in depth through this portal.') }}</p>
    </header>

    <main class="container my-3 flex-grow-1">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card section-card h-100 text-center d-flex flex-column justify-content-between">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('📖 Quran') }}</h5>
                        <p class="card-text">{{ __('Quran verses, meaning, tafseer, audio') }}</p>
                    </div>

                    <div class="card-footer bg-transparent border-0 pb-3">
                        <a href="{{ route('quran.index') }}" class="btn btn-primary">{{ __('Start learning') }}</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card section-card h-100 text-center d-flex flex-column justify-content-between">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('🕋 Hadith') }}</h5>
                        <p class="card-text">{{ __('Bukhari, Muslim and other Sahih Hadiths') }}</p>
                    </div>

                    <div class="card-footer bg-transparent border-0 pb-3">
                        <a href="{{ route('hadith.index') }}" class="btn btn-primary">{{ __('See') }}</a>
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

                        <div class="card-footer bg-transparent border-0 pb-3">
                            <a href="{{ route('questions', $item->id) }}" class="btn btn-primary">{{ __('Know More') }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection
