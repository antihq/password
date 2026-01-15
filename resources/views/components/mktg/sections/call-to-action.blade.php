@props([
    'eyebrow' => null,
    'headline' => null,
    'subheadline' => null,
    'cta' => null,
])

<section {{ $attributes->class('py-16') }}>
    <x-mktg.elements.container class="flex flex-col gap-10">
        <div class="flex flex-col gap-6">
            <div class="flex max-w-4xl flex-col gap-2">
                <x-mktg.elements.eyebrow>{{ $eyebrow }}</x-mktg.elements.eyebrow>

                <x-mktg.elements.subheading>{{ $headline }}</x-mktg.elements.subheading>
            </div>

            <x-mktg.elements.text class="flex max-w-3xl flex-col gap-4 text-pretty">{{ $subheadline }}</x-mktg.elements.text>
        </div>

        {{ $cta }}
    </x-mktg.elements.container>
</section>
