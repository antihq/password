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
        'light' => 'text-white hover:bg-white/15 dark:hover:bg-white/10',
        default => 'text-zinc-950 hover:bg-zinc-950/10 dark:text-white dark:hover:bg-white/10',
    };
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->class("inline-flex shrink-0 items-center justify-center gap-2 rounded-full text-sm/7 font-medium {$variantClasses} {$sizeClasses}") }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->class("inline-flex shrink-0 items-center justify-center gap-2 rounded-full text-sm/7 font-medium {$variantClasses} {$sizeClasses}") }}>
        {{ $slot }}
    </button>
@endif
