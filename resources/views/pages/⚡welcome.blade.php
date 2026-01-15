<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::marketing')] #[Title('Secure password & credit card management for teams.')] class extends Component
{
    //
};
?>

<x-slot name="meta">
    <meta property="og:description" content="Secure password & credit card management for teams.">
    <meta property="og:image" content="{{ url('opengraph.jpg') }}">
    <meta property="og:type" content="website">
</x-slot>

<div>
    {{-- Hero --}}
    <x-mktg.sections.hero id="hero" headline="Secure password & credit card management for teams and individuals.">
        <x-slot name="subheadline">
            <p>
                Your digital vault, reinvented — military-grade encryption, team collaboration, and beautiful design for
                managing passwords and credit cards securely.
            </p>
        </x-slot>

        <x-slot name="cta">
            <div class="flex items-center gap-4">
                <x-mktg.elements.button :href="route('register')" size="lg" wire:navigate>Sign up today</x-mktg.elements.button>
            </div>
        </x-slot>

        <x-slot name="demo">
            <x-mktg.elements.screenshot wallpaper="green" placement="bottom" class="rounded-md max-sm:hidden md:-mx-8">
                <img src="/img/screenshots/1.webp" alt="" class="bg-white/75 rounded-t-lg">
            </x-mktg.elements.screenshot>
            <x-mktg.elements.screenshot wallpaper="green" placement="bottom" class="rounded-md max-h-128 sm:hidden">
                <img src="/img/screenshots/1-mobile.webp" alt="" class="bg-white/75 rounded-t-2xl">
            </x-mktg.elements.screenshot>
        </x-slot>
    </x-mktg.sections.hero>

    {{-- Features --}}
    <x-mktg.sections.features id="features" eyebrow="Powerful features">
        <x-slot name="headline">Everything you need to secure your digital life.</x-slot>

        <x-slot:subheadline>
            <p>
                Military-grade encryption, seamless team collaboration, and beautiful design — all in one secure vault for
                your passwords and credit cards.
            </p>
        </x-slot:subheadline>

        <x-mktg.sections.feature headline="Everything in one secure vault">
            <x-slot:demo>
{{--                 <x-mktg.elements.screenshot wallpaper="purple" placement="bottom-left">
                    <img src="/img/screenshots/1.png" alt="" class="rounded-tr-lg bg-white/75 sm:hidden dark:hidden">
                    <img src="/img/screenshots/1.png" alt="" class="rounded-tr-lg bg-black/75 not-dark:hidden sm:hidden">
                    <img src="/img/screenshots/1.png" alt="" class="rounded-tr-lg bg-white/75 max-sm:hidden lg:hidden dark:hidden">
                    <img src="/img/screenshots/1.png" alt="" class="rounded-tr-lg bg-black/75 not-dark:hidden max-sm:hidden lg:hidden">
                    <img src="/img/screenshots/1.png" alt="" class="rounded-tr-lg bg-white/75 max-lg:hidden xl:hidden dark:hidden">
                    <img src="/img/screenshots/1.png" alt="" class="rounded-tr-lg bg-black/75 not-dark:hidden max-lg:hidden xl:hidden">
                    <img src="/img/screenshots/1.png" alt="" class="rounded-tr-lg bg-white/75 max-xl:hidden dark:hidden">
                    <img src="/img/screenshots/1.png" alt="" class="rounded-tr-lg bg-black/75 not-dark:hidden max-xl:hidden">
                </x-mktg.elements.screenshot> --}}
            </x-slot:demo>

            <x-slot:subheadline>
                <p>
                    Store unlimited passwords and credit cards with military-grade AES-256 encryption. Auto-fetch
                    favicons, generate strong passwords, and copy credentials with one click.
                </p>
            </x-slot:subheadline>
        </x-mktg.sections.feature>

        <x-mktg.sections.feature headline="Built for teams from day one">
{{--             <x-slot:demo>
                <x-mktg.elements.screenshot wallpaper="blue" placement="bottom-left">
                    <img src="/img/screenshots/1-right-1000-top-800.webp" alt="" class="bg-white/75 sm:hidden dark:hidden">
                    <img src="/img/screenshots/1-color-olive-right-1000-top-800.webp" alt="" class="bg-black/75 not-dark:hidden sm:hidden">
                    <img src="/img/screenshots/1-right-1800-top-660.webp" alt="" class="bg-white/75 max-sm:hidden lg:hidden dark:hidden">
                    <img src="/img/screenshots/1-color-olive-right-1800-top-660.webp" alt="" class="bg-black/75 not-dark:hidden max-sm:hidden lg:hidden">
                    <img src="/img/screenshots/1-right-1300-top-1300.webp" alt="" class="bg-white/75 max-lg:hidden xl:hidden dark:hidden">
                    <img src="/img/screenshots/1-color-olive-right-1300-top-1300.webp" alt="" class="bg-black/75 not-dark:hidden max-lg:hidden xl:hidden">
                    <img src="/img/screenshots/1-right-1800-top-1250.webp" alt="" class="bg-white/75 max-xl:hidden dark:hidden">
                    <img src="/img/screenshots/1-color-olive-right-1800-top-1250.webp" alt="" class="bg-black/75 not-dark:hidden max-xl:hidden">
                </x-mktg.elements.screenshot>
            </x-slot:demo> --}}

            <x-slot:subheadline>
                <p>
                    Create unlimited teams, invite members securely, and control access. Perfect for small businesses,
                    agencies, and families who need shared credential management.
                </p>
            </x-slot:subheadline>
        </x-mktg.sections.feature>
    </x-mktg.sections.features>

    {{-- Call To Action --}}
    <x-mktg.sections.call-to-action id="call-to-action" headline="Ready to secure your digital life?">
        <x-slot:subheadline>
            <p>
                Get started in minutes with zero setup. Sign up today and experience the most intuitive way to manage
                passwords and credit cards — for individuals and teams.
            </p>
        </x-slot:subheadline>

        <x-slot:cta>
            <div class="flex items-center gap-4">
                <x-mktg.elements.button :href="route('register')" size="lg" wire:navigate>Get started</x-mktg.elements.button>
            </div>
        </x-slot:cta>
    </x-mktg.sections.call-to-action>
</div>
