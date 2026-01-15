@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark bg-zinc-100 antialiased dark:bg-zinc-950 scroll-pt-(--scroll-padding-top)">
    <head>
        @include('partials.head')

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="" />
        <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet" />
    </head>
    <body>
        <x-mktg.sections.navbar id="navbar">
            <x-slot name="links">
                <x-mktg.sections.navbar.logo :href="route('home')" class="font-display text-2xl/9 font-medium text-zinc-950 dark:text-white" wire:navigate>
                    {{ config('app.name') }}
                </x-mktg.sections.navbar.logo>
            </x-slot>
            <x-slot name="actions">
                <x-mktg.elements.button.plain :href="route('login')" class="max-sm:hidden" wire:navigate>Log in</x-mktg.elements.button>
                <x-mktg.elements.button :href="route('register')" wire:navigate>Get started</x-mktg.elements.button>
            </x-slot>
        </x-mktg.sections.navbar>

        <main>{{ $slot }}</main>

        <x-mktg.sections.footer id="footer" fineprint="Designed, built, and backed by Oliver Servín.">
            <x-slot name="socialLinks">
                <x-mktg.sections.footer.social-link href="https://x.com/oliverservinX" name="X">
                    <x-mktg.icon.x />
                </x-mktg.sections.footer.social-link>
                <x-mktg.sections.footer.social-link href="https://github.com/antihq/password" name="GitHub">
                    <x-mktg.icon.github />
                </x-mktg.sections.footer.social-link>
            </x-slot>
        </x-mktg.sections.footer>

        @fluxScripts
    </body>
</html>
