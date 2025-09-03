@props(['ayah' => '', 'translation', 'number'])

<div class="ayah-card">
    @if ($ayah)
        <h6 class="text-arabic text-primary fw-bold mt-2 lh-lg mb-0"> ﴿ {{ $ayah }} ﴾ </h6>
    @endif

    <p class="small m-0">{{ $translation }} <em class="text-muted small"> - {{ $number }}</em></p>
</div>
