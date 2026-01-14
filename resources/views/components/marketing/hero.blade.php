<div {{ $attributes->class('relative') }}>
    {{-- <x-marketing.gradient class="absolute inset-2 bottom-0 rounded-4xl ring-1 ring-black/5 ring-inset" /> --}}

    <x-marketing.container class="relative">
        <div class="pt-16 pb-24 sm:pt-24 sm:pb-32">
            <h1
                class="text-6xl/[1.1] font-medium tracking-tight text-balance max-sm:break-words max-sm:hyphens-auto text-zinc-950 sm:text-8xl/[0.8]"
            >
                Secure password & credit card management for teams
            </h1>

            <p class="mt-8 max-w-lg text-xl/7 font-medium text-zinc-950/75 sm:text-2xl/8">
                Protect your digital life with military-grade encryption. Share credentials securely with your team. Beautiful, intuitive, and completely secure.
            </p>

            <div class="mt-12 flex flex-col gap-x-6 gap-y-4 sm:flex-row">
                <x-marketing.button :href="route('register')" variant="primary" wire:navigate>Start protecting</x-marketing.button>
            </div>
        </div>
    </x-marketing.container>
</div>
