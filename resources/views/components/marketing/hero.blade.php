<div {{ $attributes->class('relative') }}>
    <x-marketing.gradient class="absolute inset-2 bottom-0 rounded-4xl ring-1 ring-black/5 ring-inset" />

    <x-marketing.container class="relative">
        <div class="pt-16 pb-24 sm:pt-24 sm:pb-32 md:pt-32 md:pb-48">
            <h1
                class="text-6xl/[0.9] font-medium tracking-tight text-balance text-gray-950 sm:text-8xl/[0.8] md:text-9xl/[0.8]"
            >
                Close every deal.
            </h1>

            <p class="mt-8 max-w-lg text-xl/7 font-medium text-gray-950/75 sm:text-2xl/8">
                Radiant helps you sell more by revealing sensitive information about your customers.
            </p>

            <div class="mt-12 flex flex-col gap-x-6 gap-y-4 sm:flex-row">
                <x-marketing.button href="#" variant="primary">Get started</x-marketing.button>
                <x-marketing.button variant="secondary" href="/pricing">See pricing</x-marketing.button>
            </div>
        </div>
    </x-marketing.container>
</div>
