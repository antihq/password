@props([
    'eyebrow' => null,
    'headline' => null,
    'subheadline' => null,
    'cta' => null,
])

<section {{ $attributes->class('py-16') }}>
    <x-mktg.elements.container class="flex flex-col gap-10 sm:gap-16">
        @if ($headline)
            <div class="flex max-w-2xl flex-col gap-6">
                <div class="flex flex-col gap-2">
                    <x-mktg.elements.eyebrow>{{ $eyebrow }}</x-mktg.elements.eyebrow>

                    <x-mktg.elements.subheading>{{ $headline }}</x-mktg.elements.subheading>
                </div>

                <x-mktg.elements.text class="text-pretty">{{ $subheadline }}</x-mktg.elements.text>

                {{ $cta }}
            </div>
        @endif
        <div>
            {{ $slot }}
        </div>
    </x-mktg.elements.container>
</section>
