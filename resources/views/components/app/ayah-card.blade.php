@props(['ayah', 'translation', 'number'])

<div class="ayah-card">
    <h6 class="text-arabic text-primary fw-bold mt-2 lh-lg mb-0"> ﴿ {{ $ayah }} ﴾ </h6>
    <p class="fst-italic small m-0">{{ $translation }} </p>
    <p class="m-0 mt-1 text-muted small">S. {{ $number }}</p>
</div>
