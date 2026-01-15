@props([
    'eyebrow' => null,
    'headline' => null,
    'subheadline' => null,
    'cta' => null,
    'demo' => null,
])

<section {{ $attributes->class('py-16') }}>
    <x-mktg.elements.container class="flex flex-col gap-16">
        <div class="flex flex-col gap-32">
            <div class="flex flex-col items-start gap-6">
                {{ $eyebrow }}

                <x-mktg.elements.heading class="max-w-5xl">{{ $headline }}</x-mktg.elements.heading>

                <x-mktg.elements.text size="lg" class="flex max-w-3xl flex-col gap-4">
                    {{ $subheadline }}
                </x-mktg.elements.text>

                {{ $cta }}
            </div>

            {{ $demo }}
        </div>
    </x-mktg.elements.container>
</section>
