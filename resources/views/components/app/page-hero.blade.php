@props(['title' => null, 'description' => null])

<header class="page-hero">
    {!! $title ? "<h1>{$title}</h1>" : '' !!}
    {!! $description ? "<p class='small-note mb-2'>{$description}</p>" : '' !!}

    {{ $slot }}
</header>
