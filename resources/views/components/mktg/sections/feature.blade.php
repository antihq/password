@props([
    'headline' => null,
    'subheadline' => null,
    'cta' => null,
    'demo' => null,
])

<div {{ $attributes->class('rounded-lg bg-zinc-950/[0.025] p-2 dark:bg-white/[0.05]') }}>
    <div class="relative overflow-hidden rounded-sm dark:after:absolute dark:after:inset-0 dark:after:rounded-sm dark:after:outline-1 dark:after:-outline-offset-1 dark:after:outline-white/10">
        {{ $demo }}
    </div>
    <div class="flex flex-col gap-4 p-6 sm:p-10 lg:p-6">
        <div>
            <h3 class="text-base/8 font-medium text-zinc-950 dark:text-white">{{ $headline }}</h3>

            <div class="mt-2 flex flex-col gap-4 text-sm/7 text-zinc-700 dark:text-zinc-400">{{ $subheadline }}</div>
        </div>

        {{ $cta }}
    </div>
</div>
