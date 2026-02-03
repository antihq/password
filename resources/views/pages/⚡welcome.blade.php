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
    </x-mktg.sections.hero>
</div>
