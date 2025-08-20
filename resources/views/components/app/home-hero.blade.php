@props(['title' => null, 'description' => null, 'ayah' => null, 'surah' => null, 'buttons' => []])

<header class="container mt-5 pt-5">
    <section class="hero bg-geometry">
        <div class="text-center mx-auto">
            @if ($title)
                <h1 class="display-5 mb-3">{{ $title }}</h1>
            @endif

            @if ($surah || $ayah)
                <p class="ayah text-ar mb-4">
                    @if ($surah)
                        <span class="ms-2" style="opacity:.85;" dir="rtl">(طه ١١٤)</span>
                    @endif

                    @if ($ayah)
                        <span dir="rtl">﴿ وَقُل رَّبِّ زِدْنِي عِلْمًا ﴾</span>
                    @endif
                </p>
            @endif

            @if ($description)
                <p class="lead muted mb-4">{{ $description }}</p>
            @endif

            @if ($buttons)
                <div class="d-flex justify-content-center gap-2 flex-wrap">
                    @foreach ($buttons as $button)
                        <a href="{{ $button['url'] }}" class="btn btn-{{ $button['color'] }} btn-cta px-4">
                            {{ $button['label'] }}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</header>
