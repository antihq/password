<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::marketing')] #[Title('Secure password & credit card management for teams')] class extends Component
{
    //
};
?>

<div>
    {{-- Hero --}}
    <x-mktg.sections.hero id="hero">
        <x-slot name="headline">Secure password & credit card management for teams and individuals</x-slot>

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

{{--         <x-slot name="demo">
            <x-mktg.elements.screenshot wallpaper="green" placement="bottom-right" class="rounded-md">
                <img src="/img/screenshots/1-left-1670-top-1408.webp" alt="" class="bg-white/75 md:hidden dark:hidden">
                <img src="/img/screenshots/1-color-olive-left-1670-top-1408.webp" alt="" class="bg-black/75 not-dark:hidden md:hidden">
                <img src="/img/screenshots/1-left-2000-top-1408.webp" alt="" class="bg-white/75 max-md:hidden dark:hidden">
                <img src="/img/screenshots/1-color-olive-left-2000-top-1408.webp" alt="" class="bg-black/75 not-dark:hidden max-md:hidden">
            </x-mktg.elements.screenshot>
        </x-slot> --}}
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

        <x-mktg.sections.feature>
{{--             <x-slot:demo>
                <x-mktg.elements.screenshot wallpaper="purple" placement="bottom-right">
                    <img src="/img/screenshots/1-left-1000-top-800.webp" alt="" class="bg-white/75 sm:hidden dark:hidden">
                    <img src="/img/screenshots/1-color-olive-left-1000-top-800.webp" alt="" class="bg-black/75 not-dark:hidden sm:hidden">
                    <img src="/img/screenshots/1-left-1800-top-660.webp" alt="" class="bg-white/75 max-sm:hidden lg:hidden dark:hidden">
                    <img src="/img/screenshots/1-color-olive-left-1800-top-660.webp" alt="" class="bg-black/75 not-dark:hidden max-sm:hidden lg:hidden">
                    <img src="/img/screenshots/1-left-1300-top-1300.webp" alt="" class="bg-white/75 max-lg:hidden xl:hidden dark:hidden">
                    <img src="/img/screenshots/1-color-olive-left-1300-top-1300.webp" alt="" class="bg-black/75 not-dark:hidden max-lg:hidden xl:hidden">
                    <img src="/img/screenshots/1-left-1800-top-1250.webp" alt="" class="bg-white/75 max-xl:hidden dark:hidden">
                    <img src="/img/screenshots/1-color-olive-left-1800-top-1250.webp" alt="" class="bg-black/75 not-dark:hidden max-xl:hidden">
                </x-mktg.elements.screenshot>
            </x-slot:demo> --}}

            <x-slot:headline>Everything in One Secure Vault</x-slot:headline>

            <x-slot:subheadline>
                <p>
                    Store unlimited passwords and credit cards with military-grade AES-256 encryption. Auto-fetch
                    favicons, generate strong passwords, and copy credentials with one click.
                </p>
            </x-slot:subheadline>
        </x-mktg.sections.feature>

        <x-mktg.sections.feature>
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

            <x-slot:headline>Built for Teams from Day One</x-slot:headline>

            <x-slot:subheadline>
                <p>
                    Create unlimited teams, invite members securely, and control access. Perfect for small businesses,
                    agencies, and families who need shared credential management.
                </p>
            </x-slot:subheadline>
        </x-mktg.sections.feature>
    </x-mktg.sections.features>

    {{-- Call To Action --}}
    <x-mktg.sections.call-to-action id="call-to-action" headline="Ready to Secure Your Digital Life?">
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
