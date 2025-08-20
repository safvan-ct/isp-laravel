@props(['title' => null, 'subTitle' => null, 'dot' => true])

<div class="subject-card">
    @if ($dot)
        <span class="subject-dot"></span>
    @endif

    @if ($title || $subTitle)
        <div>
            @if ($title)
                <div class="fw-bold">{{ $title }}</div>
            @endif

            @if ($subTitle)
                <small class="text-secondary">{{ $subTitle }}</small>
            @endif
        </div>
    @endif
</div>
