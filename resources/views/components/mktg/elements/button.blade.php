@props([
    'variant' => 'dark/light',
    'type' => 'button',
    'href' => null,
    'size' => 'md',
])

@php
    $sizeClasses = match($size) {
        'lg' => 'px-4 py-2',
        'md' => 'px-3 py-1',
        default => 'px-3 py-1',
    };

    $variantClasses = match($variant) {
        'dark/light' => 'bg-zinc-950 text-white hover:bg-zinc-800 dark:bg-zinc-300 dark:text-zinc-950 dark:hover:bg-zinc-200',
        'light' => 'bg-white text-zinc-950 hover:bg-zinc-100 dark:bg-zinc-100 dark:hover:bg-white',
        default => 'bg-zinc-950 text-white hover:bg-zinc-800 dark:bg-zinc-300 dark:text-zinc-950 dark:hover:bg-zinc-200',
    };
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->class("inline-flex shrink-0 items-center justify-center gap-1 rounded-full text-sm/7 font-medium {$variantClasses} {$sizeClasses}") }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->class("inline-flex shrink-0 items-center justify-center gap-1 rounded-full text-sm/7 font-medium {$variantClasses} {$sizeClasses}") }}>
        {{ $slot }}
    </button>
@endif
