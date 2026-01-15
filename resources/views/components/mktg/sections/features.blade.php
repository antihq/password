@props([
    'eyebrow' => null,
    'headline' => null,
    'subheadline' => null,
    'cta' => null,
])

<x-mktg.sections.section
    :eyebrow="$eyebrow"
    :headline="$headline"
    :subheadline="$subheadline"
    :cta="$cta"
    {{ $attributes }}
>
    <div class="grid grid-cols-1 gap-2">
        {{ $slot }}
    </div>
</x-mktg.sections.section>
