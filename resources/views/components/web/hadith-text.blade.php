@props(['hadith', 'translation', 'number', 'heading' => null, 'headingTranslation' => null])

@if ($heading)
    <div class="row flex-column flex-md-row">
        <div class="col-12 col-md-6 order-1 order-md-2">
            <h6 class="ayah-arabic notranslate fw-bold text-hadith fs-5 m-0" style="line-height: 1.6;">
                {{ $heading }}
            </h6>
        </div>

        <div class="col-12 col-md-6 order-2 order-md-1">
            <h6 class="fw-bold fs-6 hadith-tr-text">{{ $headingTranslation }}</h6>
        </div>
    </div>
    <hr>
@endif

<div class="row flex-column flex-md-row">
    <div class="col-12 col-md-6 order-1 order-md-2">
        <div class="ayah-arabic notranslate text-hadith" style="font-size: 20px; line-height: 1.6;">
            {{ $hadith }}
            (<span class="fst-italic fs-6 ar-number">{{ $number }}</span>)
        </div>
    </div>

    <div class="col-12 col-md-6 order-2 order-md-1">
        <div class="text-en hadith-tr-text">{{ $translation }}</div>
    </div>
</div>
