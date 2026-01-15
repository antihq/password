@props(['color' => 'dark/light'])

@php
    $colorClass = $color === 'light' ? 'text-white' : 'text-zinc-950 dark:text-white';
@endphp

<h1 {{ $attributes->class("font-display text-5xl/12 tracking-tight text-balance sm:text-[5rem]/20 {$colorClass}") }}>
    {{ $slot }}
</h1>
