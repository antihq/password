<x-layouts::app.header :title="$title ?? null">
    <flux:main class="flex flex-1 flex-col px-0! pt-0! pb-0! sm:px-2!">
        <div
            class="grow p-6 sm:rounded-lg sm:bg-white sm:p-10 sm:shadow-xs sm:ring-1 sm:ring-zinc-950/5 dark:lg:bg-zinc-900 dark:lg:ring-white/10"
        >
            {{ $slot }}
        </div>
    </flux:main>

    <flux:footer class="px-6! py-3! flex sm:mx-auto">
        <flux:text class="text-sm/5 sm:text-[13px]/5">
            <flux:link href="/" :accent="false" wire:navigate>{{ config('app.name') }}</flux:link>
            is designed, built, and backed by
            <flux:link href="https://x.com/oliverservinX" :accent="false">Oliver Servín</flux:link>.
            Need help? Send an email to
            <flux:link href="mailto:oliver@antihq.com" :accent="false">oliver@antihq.com</flux:link>.
        </flux:text>
    </flux:footer>

    @persist('toast')
        <flux:toast position="bottom center" />
    @endpersist
</x-layouts::app.header>
