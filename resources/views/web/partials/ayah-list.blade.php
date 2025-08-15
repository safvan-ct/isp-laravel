@foreach ($result as $item)
    <x-web.ayah-card class="pb-0">
        <x-web.ayah-text :text="$item->text" :number="$item->number_in_chapter" />

        @if ($item->translation)
            <x-web.text-translation :text="$item->translation->text" />
        @endif

        <x-web.actions :type="'quran'" :item="$item->id" :chapter="$item->chapter->id" :ayah="$item->number_in_chapter" :bookmarked="isset($bookmarked) ? $bookmarked : false"
            :liked="isset($liked) ? $liked : false" />
    </x-web.ayah-card>
@endforeach

<script>
    $('.ar-number').each(function() {
        const number = $(this).text().trim();
        $(this).text(toArabicNumber(number));
    });
</script>
