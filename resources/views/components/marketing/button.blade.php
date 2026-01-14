@props([
    'variant' => 'primary',
    'type' => 'button',
    'href' => null,
])

@php
    $classes = 'font-medium whitespace-nowrap transition-colors duration-200';

    if ($variant === 'primary') {
        $classes .= ' inline-flex items-center justify-center px-4 py-[calc(--spacing(2)-1px)]';
        $classes .= ' rounded-full border border-transparent bg-zinc-950 shadow-md';
        $classes .= ' text-base text-white';
        $classes .= ' hover:bg-zinc-800';
        $classes .= ' disabled:bg-zinc-950 disabled:opacity-40 disabled:cursor-default disabled:pointer-events-none';
    } elseif ($variant === 'outline') {
        $classes .= ' inline-flex items-center justify-center px-2 py-[calc(--spacing(1.5)-1px)]';
        $classes .= ' rounded-lg border border-transparent shadow-sm ring-1 ring-black/10';
        $classes .= ' text-sm text-zinc-950';
        $classes .= ' hover:bg-zinc-50';
        $classes .= ' disabled:bg-transparent disabled:opacity-40 disabled:cursor-default disabled:pointer-events-none';
    } elseif ($variant === 'secondary') {
        $classes .= ' relative inline-flex items-center justify-center px-4 py-[calc(--spacing(2)-1px)]';
        $classes .= ' rounded-full border border-transparent bg-white/15 shadow-md ring-1 ring-[#D15052]/15';
        $classes .= ' after:absolute after:inset-0 after:rounded-full after:shadow-[inset_0_0_2px_1px_#ffffff4d]';
        $classes .= ' text-base font-medium whitespace-nowrap text-zinc-950';
        $classes .= ' hover:bg-white/20';
        $classes .= ' disabled:bg-white/15 disabled:opacity-40';
    }
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->class($classes) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->class($classes) }}>
        {{ $slot }}
    </button>
@endif
