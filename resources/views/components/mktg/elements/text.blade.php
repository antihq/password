@props(['size' => 'md'])

@php
    $sizeClass = $size === 'lg' ? 'text-lg/8' : 'text-base/7';
@endphp

<div {{ $attributes->class("{$sizeClass} text-zinc-700 dark:text-zinc-400") }}>
    {{ $slot }}
</div>
