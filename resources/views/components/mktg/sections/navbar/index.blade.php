<header {{ $attributes->class('bg-zinc-100 dark:bg-zinc-950 sticky top-0 z-10') }}>
    <nav>
        <div class="mx-auto flex h-(--scroll-padding-top) max-w-7xl items-center gap-4 px-6 lg:px-10">
            <div class="flex flex-1 gap-8">{{ $links ?? null }}</div>
            <div class="flex items-center">{{ $logo ?? null }}</div>
            <div class="flex flex-1 items-center justify-end gap-4">
                <div class="flex shrink-0 items-center gap-5">{{ $actions ?? null }}</div>
            </div>
        </div>
    </nav>
</header>

<style>:root { --scroll-padding-top: 5.25rem }</style>
