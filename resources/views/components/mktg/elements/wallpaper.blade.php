@props(['color' => 'green'])

@php
    $colorClasses = match($color) {
        'green' => 'from-[#9ca88f] to-[#596352] dark:from-[#333a2b] dark:to-[#26361b]',
        'blue' => 'from-[#637c86] to-[#778599] dark:from-[#243a42] dark:to-[#232f40]',
        'purple' => 'from-[#7b627d] to-[#8f6976] dark:from-[#412c42] dark:to-[#3c1a26]',
        'brown' => 'from-[#8d7359] to-[#765959] dark:from-[#382d23] dark:to-[#3d2323]',
        default => 'from-[#9ca88f] to-[#596352] dark:from-[#333a2b] dark:to-[#26361b]',
    };
@endphp

<div {{ $attributes->class("relative overflow-hidden bg-gradient-to-b {$colorClasses}") }}>
    <div class="absolute inset-0 opacity-30 mix-blend-overlay dark:opacity-25" style="background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22250%22 height=%22250%22 viewBox=%220 0 100 100%22%3E%3Cfilter id=%22n%22%3E%3CfeTurbulence type=%22turbulence%22 baseFrequency=%221.4%22 numOctaves=%221%22 seed=%222%22 stitchTiles=%22stitch%22 result=%22n%22/%3E%3CfeComponentTransfer result=%22g%22%3E%3CfeFuncR type=%22linear%22 slope=%224%22 intercept=%221%22/%3E%3CfeFuncG type=%22linear%22 slope=%224%22 intercept=%221%22/%3E%3CfeFuncB type=%22linear%22 slope=%224%22 intercept=%221%22/%3E%3C/feComponentTransfer%3E%3CfeColorMatrix type=%22saturate%22 values=%220%22 in=%22g%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23n)%22/%3E%3C/svg%3E'); background-position: center;"></div>
    <div class="relative">
        {{ $slot }}
    </div>
</div>
