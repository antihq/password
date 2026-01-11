<?php

use App\Models\Password;
use Livewire\Component;

new class extends Component
{
    public Password $password;

    public function copyToClipboard(string $text): void
    {
        $this->js("navigator.clipboard.writeText('{$text}')");
    }
};
?>

<li wire:key="password-{{ $password->id }}" class="relative flex justify-between gap-x-6 py-5">
    <div class="flex min-w-0 gap-x-4">
        <div class="min-w-0 flex-auto">
            <flux:heading>
                <a href="{{ route('passwords.edit', $password) }}">
                    <span class="absolute inset-x-0 -top-px bottom-0"></span>
                    {{ $password->name }}
                </a>
            </flux:heading>
            <flux:text size="sm">
                {{ $password->username }}
            </flux:text>
        </div>
    </div>
    <div class="flex shrink-0 items-center gap-x-4">
        <flux:dropdown align="end">
            <flux:button icon="ellipsis-horizontal" variant="ghost" square />

            <flux:menu>
                <flux:menu.item :href="route('passwords.edit', $password)" icon="pencil">
                    Edit
                </flux:menu.item>
                <flux:menu.item variant="danger" icon="trash" wire:click="$parent.delete({{ $password->id }})">
                    Delete
                </flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    </div>
</li>
