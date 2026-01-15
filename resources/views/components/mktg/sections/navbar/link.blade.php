<a
    {{ $attributes->class('group inline-flex items-center justify-between gap-2 text-3xl/10 font-medium text-zinc-950 lg:text-sm/7 dark:text-white') }}
>
    {{ $slot }}
    <span class="inline-flex p-1.5 opacity-0 group-hover:opacity-100 lg:hidden" aria-hidden="true">
        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>
    </span>
</a>
