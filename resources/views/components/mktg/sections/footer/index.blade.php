<footer {{ $attributes->class('pt-16') }}>
    <div class="bg-zinc-950/2.5 py-16 text-zinc-950 dark:bg-white/5 dark:text-white">
        <div class="mx-auto flex w-full max-w-2xl flex-col gap-16 px-6 lg:px-10">
            <div class="flex items-start justify-between gap-10 text-sm/6">
                <div class="text-zinc-600 dark:text-zinc-500">{{ $fineprint }}</div>
                @if ($socialLinks ?? null)
                    <div class="flex items-center gap-4 sm:gap-10">
                        {{ $socialLinks }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</footer>
