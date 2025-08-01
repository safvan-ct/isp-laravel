@extends('layouts.web')

@section('title', 'ഖുർആൻ പഠനം')

@section('content')
    <main class="container my-3">
        <div class="index-card">
            <h3 class="text-center quran-text">القرآن الكريم</h3>
            <p class="text-center">
                The Qur'an is the final divine revelation sent to humanity through Prophet Muhammad ﷺ. It consists
                of 114 Surahs (chapters), each offering divine guidance, laws, morals, stories, and reflections for
                life. This sacred text has been preserved unchanged and continues to be a source of light and
                wisdom.
            </p>

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
