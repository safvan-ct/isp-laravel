@extends('layouts.web')

@section('title', $module->translation?->title ?: $module->slug)

@section('content')
    <header class="text-white text-center py-3">
        <div class="container">
            <h3>{{ $module->translation?->title ?: $module->slug }}</h3>
            <p>{!! $module->translation?->sub_title !!}</p>

            <nav aria-label="breadcrumb" class="custom-breadcrumb rounded p-2 mt-1">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-decoration-none">{{ __('Home') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('modules.show', $module->parent->slug) }}" class="text-decoration-none">
                            {{ $module->parent->translation?->title ?: $module->parent->slug }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-muted" aria-current="page">
                        {{ $module->translation?->title ?: $module->slug }}
                    </li>
                </ol>
            </nav>
        </div>
    </header>

    <main class="container my-3 col-two flex-grow-1">
        @foreach ($module->children as $item)
            <div class="guide-card mb-2">
                <a href="{{ route('answers', $item->id) }}" class="guide-title text-decoration-none">
                    <span class="guide-number m-0">{{ $loop->iteration }}</span> -
                    {{ $item->translation?->title ?: $item->slug }}
                </a>
                <a href="{{ route('answers', $item->id) }}" class="view-btn">
                    <i class="bi bi-arrow-right-circle-fill"></i>
                </a>
            </div>
        @endforeach
    </main>
@endsection

@push('scripts')
@endpush
