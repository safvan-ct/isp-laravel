@extends('layouts.web')

@section('title', __('app.quran'))

@section('content')
    <main class="container my-3 flex-grow-1">
        <div class="index-card">
            <h3 class="text-center quran-text">القرآن الكريم</h3>
            <p class="text-center"> {{ __('app.quran_desc') }} </p>

            <ul class="index-list mt-2">
                @foreach ($chapters as $chapter)
                    <a href="{{ route('quran.chapter', $chapter->id) }}" class="text-decoration-none">
                        <li class="mb-2">
                            {{ $chapter->id }}. {{ $chapter->translation?->name ?: $chapter->name }}
                            <i class="bi bi-play-fill"></i>
                        </li>
                    </a>
                @endforeach
            </ul>
        </div>
    </main>
@endsection
