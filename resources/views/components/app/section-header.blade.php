@props(['title' => null, 'description' => null])

<header class="text-center mb-4">
    @if ($title)
        <h2 class="section-heading">{{ $title }}</h2>
    @endif

    @if ($description)
        <p class="muted">{{ $description }}</p>
    @endif
</header>
