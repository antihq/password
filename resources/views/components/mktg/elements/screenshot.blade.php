@props([
    'wallpaper' => 'green',
    'placement' => 'bottom',
])

@php
    $paddingClasses = match($placement) {
        'bottom' => 'px-[10%] pt-[10%]',
        'bottom-left' => 'pt-[10%] pr-[10%]',
        'bottom-right' => 'pt-[10%] pl-[10%]',
        'top' => 'px-[10%] pb-[10%]',
        'top-left' => 'pr-[10%] pb-[10%]',
        'top-right' => 'pb-[10%] pl-[10%]',
        default => 'px-[10%] pt-[10%]',
    };

    $roundedClasses = match($placement) {
        'bottom' => 'rounded-t-sm',
        'bottom-left' => 'rounded-tr-sm',
        'bottom-right' => 'rounded-tl-sm',
        'top' => 'rounded-b-sm',
        'top-left' => 'rounded-br-sm',
        'top-right' => 'rounded-bl-sm',
        default => 'rounded-t-sm',
    };
@endphp

<x-mktg.elements.wallpaper :color="$wallpaper" {{ $attributes->class('group') }}>
    <div class="{{ $paddingClasses }}">
        <div>
            {{ $slot }}
        </div>
    </div>
</x-mktg.elements.wallpaper>
