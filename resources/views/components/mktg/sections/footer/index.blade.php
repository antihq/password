<footer {{ $attributes->class('pt-16') }}>
    <div class="bg-zinc-950/2.5 py-16 text-zinc-950 dark:bg-white/5 dark:text-white">
        <x-mktg.elements.container class="flex flex-col gap-10 text-center text-sm/7">
            <div class="text-zinc-600 dark:text-zinc-500">{{ $fineprint }}</div>
            @if ($socialLinks ?? null)
                <div class="flex items-center justify-center gap-10">
                    {{ $socialLinks }}
                </div>
            @endif
        </x-mktg.elements.container>
    </div>
</footer>
