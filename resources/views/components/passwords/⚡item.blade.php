<?php

use App\Models\Password;
use Livewire\Component;

new class extends Component
{
    public Password $password;
};
?>

<li wire:key="password-{{ $password->id }}" class="relative flex justify-between gap-x-6 py-5">
    <div class="flex min-w-0 gap-x-4">
        <div class="min-w-0 flex-auto">
            <flux:heading>
                <flux:modal.trigger name="view-password-{{ $password->id }}">
                    <span class="absolute inset-x-0 -top-px bottom-0"></span>
                    {{ $password->name }}
                </flux:modal.trigger>
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
                <flux:menu.item variant="danger" icon="trash" wire:click="$parent.delete({{ $password->id }})">
                    Delete
                </flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    </div>

    <flux:modal name="view-password-{{ $password->id }}" class="w-full sm:max-w-lg">
        <div class="space-y-6">
            <div class="space-y-2">
                <flux:heading size="lg">{{ $password->name }}</flux:heading>
                <flux:text>View your password details below.</flux:text>
            </div>

            <flux:input :value="$password->name" label="Name" readonly variant="filled" />

            <flux:input :value="$password->username" label="Username" readonly variant="filled" copyable />

            <flux:input :value="$password->password" label="Password" readonly variant="filled" copyable viewable />
        </div>
    </flux:modal>
</li>
