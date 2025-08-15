@extends('layouts.web')

@section('title', __('app.quran') . ' | ' . ($chapter->translation?->name ?? $chapter->name))

@section('content')
    <x-web.container>
        <x-web.index-card class="b-top">
            <x-web.chapter-header :name="(optional($chapter->translation)->name ? $chapter->translation->name . ' | ' : '') .
                $chapter->name">

                <div>
                    {{ __('app.chapter') }}: <strong class="ar-number">{{ $chapter->id }}</strong> |
                    {{ __('app.ayahs') }}: <strong class="ar-number">{{ $chapter->no_of_verses }}</strong>
                </div>
            </x-web.chapter-header>

            @foreach ($chapter->verses as $item)
                <x-web.ayah-card class="pb-0">
                    <x-web.ayah-text :text="$item->text" :number="$item->number_in_chapter" />

                    @if ($item->translation)
                        <x-web.text-translation :text="$item->translation->text" />
                    @endif

                    <x-web.actions :type="'quran'" :item="$item->id" :chapter="$chapter->id" :ayah="$item->number_in_chapter" />
                </x-web.ayah-card>
            @endforeach
        </x-web.index-card>
    </x-web.container>
@endsection

@push('scripts')
    <script>
        $(function() {
            updateAllLikeIcon('quran');
            updateAllBookmarkIcon('quran');
        });
    </script>
@endpush
