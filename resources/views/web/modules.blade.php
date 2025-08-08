@extends('layouts.web')

@section('title', $topic->translation?->title ?: $topic->slug)

@section('content')
    <header class="text-white text-center py-3 notranslate">
        <div class="container">
            <h1 class="m-0 p-0">{{ $topic->translation?->title ?: $topic->slug }}</h1>
        </div>
    </header>

    <main class="container my-3 flex-grow-1">
        <div class="row g-4">
            @foreach ($topic->children as $item)
                <div class="col-md-4">
                    <div class="cat-box d-flex flex-column">
                        <div>
                            <div class="cat-title">{{ $item->translation?->title ?: $item->slug }}</div>
                            {!! $item->translation?->content !!}
                        </div>
                        <a href="{{ route('questions.show', ['menu_slug' => $topic->slug, 'module_slug' => $item->slug]) }}"
                            class="btn btn-primary mt-3 mb-0">
                            {{ __('Know More') }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection

@push('scripts')
@endpush
