<?php

use App\Models\Password;
use Flux\Flux;
use Livewire\Component;

new class extends Component {
    public Password $password;

    public string $name = '';

    public string $username = '';

    public string $newPassword = '';

    public string $website = '';

    public function mount(): void
    {
        $this->name = $this->password->name;
        $this->username = $this->password->username;
        $this->newPassword = $this->password->password;
        $this->website = $this->password->website ?? '';
    }

    public function cancelEdit(): void
    {
        $this->name = $this->password->name;
        $this->username = $this->password->username;
        $this->newPassword = $this->password->password;
        $this->website = $this->password->website ?? '';
    }

    public function save(): void
    {
        $this->authorize('update', $this->password);

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'newPassword' => ['required', 'string'],
            'website' => ['nullable', 'url', 'max:255'],
        ]);

        $this->password->update([
            'name' => $this->name,
            'username' => $this->username,
            'password' => $this->newPassword,
            'website' => $this->website ?: null,
        ]);

        Flux::modal("edit-password-{$this->password->id}")->close();
    }
};
?>

<li {{ $attributes }}>
    <div
        class="relative flex justify-between gap-x-6 rounded-lg px-3.5 py-2.5 hover:bg-zinc-950/2.5 sm:px-3 sm:py-1.5 dark:hover:bg-white/2.5"
    >
        <div class="flex min-w-0 gap-x-4">
            <div class="shrink-0 max-sm:-mt-0.5">
                @if($password->avatar_url)
                    <flux:avatar :src="$password->avatar_url" size="xs" class="bg-transparent" />
                @else
                    <flux:avatar size="xs">
                        <x-boring-avatar
                            :name="$password->name"
                            variant="marble"
                            class="size-7 sm:size-6 rounded-[var(--avatar-radius)]"
                            square
                        />
                    </flux:avatar>
                @endif
            </div>
            <div class="min-w-0 flex-auto">
                <flux:heading class="truncate">
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
                <flux:button icon="ellipsis-horizontal" variant="ghost" square class="-mr-2" />

                <flux:menu>
                    <flux:modal.trigger name="view-password-{{ $password->id }}">
                        <flux:menu.item icon="eye">View</flux:menu.item>
                    </flux:modal.trigger>
                    <flux:modal.trigger name="edit-password-{{ $password->id }}">
                        <flux:menu.item icon="pencil">Edit</flux:menu.item>
                    </flux:modal.trigger>
                    <flux:modal.trigger name="delete-password-{{ $password->id }}">
                        <flux:menu.item variant="danger" icon="trash">Delete</flux:menu.item>
                    </flux:modal.trigger>
                </flux:menu>
            </flux:dropdown>
        </div>
    </div>
    <flux:modal name="view-password-{{ $password->id }}" :closable="false" class="w-full sm:max-w-lg">
        <div class="space-y-8">
            <div class="space-y-6">
                <div class="flex items-center justify-between flex-wrap gap-2">
                    <div class="flex items-center gap-4">
                        @if($password->avatar_url)
                            <flux:avatar :src="$password->avatar_url" size="md" />
                        @else
                            <flux:avatar size="md">
                                <x-boring-avatar
                                    :name="$password->name"
                                    variant="marble"
                                    class="size-11 sm:size-10 rounded-[var(--avatar-radius)]"
                                    square
                                />
                            </flux:avatar>
                        @endif
                        <flux:heading size="lg">{{ $password->name }}</flux:heading>
                    </div>
                    <flux:modal.trigger name="edit-password-{{ $password->id }}">
                        <flux:button class="-my-0.5">Edit</flux:button>
                    </flux:modal.trigger>
                </div>

                <flux:input
                    wire:key="view-username"
                    :value="$password->username"
                    label="Username"
                    readonly
                    variant="filled"
                    copyable
                />

                <flux:input
                    wire:key="view-password"
                    :value="$password->password"
                    label="Password"
                    type="password"
                    readonly
                    variant="filled"
                    copyable
                    viewable
                />

                @if($password->website)
                    <flux:input
                        wire:key="view-website"
                        :value="$password->website"
                        label="Website"
                        readonly
                        variant="filled"
                        copyable
                    >
                        <x-slot name="iconTrailing">
                            <a href="{{ $password->website }}" target="_blank" rel="noopener noreferrer">
                                <flux:button size="sm" variant="subtle" icon="arrow-top-right-on-square" icon:variant="micro" class="-mr-1" square />
                            </a>
                        </x-slot>
                    </flux:input>
                @endif
            </div>
        </div>
    </flux:modal>
    <flux:modal name="edit-password-{{ $password->id }}" class="w-full sm:max-w-lg">
        <form wire:submit="save" class="space-y-8">
            <div class="space-y-6">
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <flux:heading size="lg">Edit password</flux:heading>
                    </div>
                    <flux:text>Update your password details below.</flux:text>
                </div>

                <flux:input wire:model="name" label="Name" type="text" required />

                <flux:input wire:model="username" label="Username" type="text" required />

                <flux:input wire:model="newPassword" label="Password" type="text" required />

                <flux:input wire:model="website" label="Website" type="url" placeholder="https://example.com" />
            </div>

            <div class="flex flex-col-reverse items-center justify-end gap-3 *:w-full sm:flex-row sm:*:w-auto">
                <flux:modal.close>
                    <flux:button wire:click="cancelEdit" variant="ghost" class="w-full sm:w-auto">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">Save</flux:button>
            </div>
        </form>
    </flux:modal>
    <flux:modal name="delete-password-{{ $password->id }}" class="w-full max-w-xs sm:max-w-md">
        <div class="space-y-6 sm:space-y-4">
            <div>
                <flux:heading>Are you sure you want to delete this password?</flux:heading>
                <flux:text class="mt-2">
                    This will permanently delete the password credentials for "{{ $password->name }}". This action
                    cannot be reversed.
                </flux:text>
            </div>
            <div class="flex flex-col-reverse items-center justify-end gap-3 *:w-full sm:flex-row sm:*:w-auto">
                <flux:modal.close>
                    <flux:button variant="ghost" class="w-full sm:w-auto">Cancel</flux:button>
                </flux:modal.close>
                <flux:button wire:click="$parent.delete({{ $password->id }})" variant="primary">Delete</flux:button>
            </div>
        </div>
    </flux:modal>
</li>
