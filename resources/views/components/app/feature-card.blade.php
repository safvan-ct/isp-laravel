@props(['icon' => null, 'title' => null, 'description' => null, 'href' => null, 'btnText' => null])

<article class="feature-card h-100">
    @if ($icon)
        <div class="icon-wrap"><span>{{ $icon }}</span></div>
    @endif

    @if ($title)
        <h3 class="h5 mb-1">{{ $title }}</h3>
    @endif

    @if ($description)
        <p class="mb-3 text-secondary">{{ $description }}</p>
    @endif

    @if ($href)
        <a href="{{ $href }}" class="btn btn-sm btn-outline-success rounded-pill">{{ $btnText ?? 'Open' }}</a>
    @endif
</article>
