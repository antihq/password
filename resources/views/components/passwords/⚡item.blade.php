<?php

use App\Models\Password;
use App\Models\Team;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {
    public Password $password;

    public string $name = '';

    public string $username = '';

    public string $newPassword = '';

    public string $website = '';

    public string $notes = '';

    public bool $viewPassword = false;

    public function mount(): void
    {
        $this->resetFormFields();
    }

    public function toggleViewPassword(): void
    {
        $this->viewPassword = ! $this->viewPassword;
    }

    private function resetFormFields(): void
    {
        $this->name = $this->password->name;
        $this->username = $this->password->username;
        $this->newPassword = $this->password->password;
        $this->website = $this->password->website ?? '';
        $this->notes = $this->password->notes ?? '';
    }

    public function cancelEdit(): void
    {
        $this->resetFormFields();
    }

    #[Computed]
    public function team(): Team
    {
        return Auth::user()->currentTeam;
    }

    #[Computed]
    public function existingUsernames()
    {
        return $this->team
            ->passwords()
            ->pluck('username')
            ->unique()
            ->sort()
            ->values();
    }

    public function generateNewPassword(): void
    {
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $alphanumeric = $lowercase . '0123456789';

        $part1 = substr(str_shuffle(str_repeat($lowercase, 3)), 0, 6);
        $part2 = substr(str_shuffle(str_repeat($alphanumeric, 3)), 0, 6);
        $part3 = ucfirst(substr(str_shuffle(str_repeat($lowercase, 3)), 0, 6));

        $this->newPassword = "{$part1}-{$part2}-{$part3}";
    }

    public function save(): void
    {
        $this->authorize('update', $this->password);

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'newPassword' => ['required', 'string'],
            'website' => ['nullable', 'url', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);

        $this->password->update([
            'name' => $this->name,
            'username' => $this->username,
            'password' => $this->newPassword,
            'website' => $this->website ?: null,
            'notes' => $this->notes ?: null,
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
                @if ($password->avatar_url)
                    <flux:avatar :src="$password->avatar_url" size="xs" class="bg-transparent" />
                @else
                    <flux:avatar size="xs">
                        <x-boring-avatar
                            :name="$password->name"
                            variant="marble"
                            class="size-7 rounded-[var(--avatar-radius)] sm:size-6"
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
                <div class="flex flex-wrap items-center justify-between gap-2">
                    <div class="flex items-center gap-4">
                        @if ($password->avatar_url)
                            <flux:avatar :src="$password->avatar_url" size="md" />
                        @else
                            <flux:avatar size="md">
                                <x-boring-avatar
                                    :name="$password->name"
                                    variant="marble"
                                    class="size-11 rounded-[var(--avatar-radius)] sm:size-10"
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

                <div class="space-y-3 divide-y divide-zinc-950/5 dark:divide-white/5">
                    <div class="pb-3">
                        <div class="flex items-end justify-between gap-2">
                            <div class="space-y-1">
                                <flux:text>Username</flux:text>
                                <flux:text variant="strong">{{ $password->username }}</flux:text>
                            </div>
                            <flux:button
                                variant="subtle"
                                inset="right"
                                square
                                x-data="{ copied: false }"
                                data-copy-value="{{ $password->username }}"
                                x-on:click="
                                    copied = ! copied
                                    navigator.clipboard && navigator.clipboard.writeText($el.dataset.copyValue)
                                    setTimeout(() => (copied = false), 2000)
                                "
                                x-bind:data-copyable-copied="copied"
                            >
                                <flux:icon.clipboard-document-check
                                    variant="micro"
                                    class="hidden size-5 sm:size-4 [[data-copyable-copied]>&]:block"
                                />
                                <flux:icon.clipboard-document
                                    variant="micro"
                                    class="block size-5 sm:size-4 [[data-copyable-copied]>&]:hidden"
                                />
                            </flux:button>
                        </div>
                    </div>
                    <div class="pb-3">
                        <div class="flex items-end justify-between gap-2">
                            <div class="space-y-1">
                                <flux:text>Password</flux:text>
                                <flux:text variant="strong">
                                    {{ $viewPassword ? $password->password : '••••••••••••' }}
                                </flux:text>
                            </div>
                            <div class="flex gap-0.5">
                                <flux:button
                                    variant="subtle"
                                    :icon="$viewPassword ? 'eye-slash' : 'eye'"
                                    icon:variant="micro"
                                    square
                                    wire:click="toggleViewPassword"
                                />
                                <flux:button
                                    variant="subtle"
                                    inset="right"
                                    square
                                    x-data="{ copied: false }"
                                    data-copy-value="{{ $password->password }}"
                                    x-on:click="
                                        copied = ! copied
                                        navigator.clipboard && navigator.clipboard.writeText($el.dataset.copyValue)
                                        setTimeout(() => (copied = false), 2000)
                                    "
                                    x-bind:data-copyable-copied="copied"
                                >
                                    <flux:icon.clipboard-document-check
                                        variant="micro"
                                        class="hidden size-5 sm:size-4 [[data-copyable-copied]>&]:block"
                                    />
                                    <flux:icon.clipboard-document
                                        variant="micro"
                                        class="block size-5 sm:size-4 [[data-copyable-copied]>&]:hidden"
                                    />
                                </flux:button>
                            </div>
                        </div>
                    </div>
                    <div class="pb-3">
                        <div class="flex items-end justify-between gap-2">
                            <div class="space-y-1">
                                <flux:text>Website</flux:text>
                                <flux:text variant="strong">
                                    <flux:link :href="$password->website">{{ $password->website_hostname }}</flux:link>
                                </flux:text>
                            </div>
                            <div class="flex gap-0.5">
                                <flux:button
                                    variant="subtle"
                                    inset="right"
                                    square
                                    x-data="{ copied: false }"
                                    data-copy-value="{{ $password->website }}"
                                    x-on:click="
                                        copied = ! copied
                                        navigator.clipboard && navigator.clipboard.writeText($el.dataset.copyValue)
                                        setTimeout(() => (copied = false), 2000)
                                    "
                                    x-bind:data-copyable-copied="copied"
                                >
                                    <flux:icon.clipboard-document-check
                                        variant="micro"
                                        class="hidden size-5 sm:size-4 [[data-copyable-copied]>&]:block"
                                    />
                                    <flux:icon.clipboard-document
                                        variant="micro"
                                        class="block size-5 sm:size-4 [[data-copyable-copied]>&]:hidden"
                                    />
                                </flux:button>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($password->notes)
                    <flux:accordion>
                        <flux:accordion.item heading="Notes">
                            <x-prose>
                                {!! $password->sanitizedNotes() !!}
                            </x-prose>
                        </flux:accordion.item>
                    </flux:accordion>
                @endif
            </div>
        </div>
    </flux:modal>
    <flux:modal name="edit-password-{{ $password->id }}" class="w-full sm:max-w-lg" @close="$refresh">
        @island(lazy: true)
            @placeholder
                <div class="space-y-8">
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <flux:skeleton class="h-7 w-1/3" />
                            </div>
                            <flux:skeleton.line class="w-2/3" />
                        </div>

                        <flux:skeleton.line class="h-10" />

                        <flux:skeleton.line class="h-10" />

                        <flux:skeleton.line class="h-10" />

                        <div class="grid gap-4 sm:grid-cols-2">
                            <flux:skeleton.line class="h-10" />
                            <flux:skeleton.line class="h-10" />
                        </div>

                        <flux:skeleton.line class="h-10" />

                        <flux:skeleton class="h-[100px] w-full rounded-lg" />
                    </div>

                    <div class="flex flex-col-reverse items-center justify-end gap-3 *:w-full sm:flex-row sm:*:w-auto">
                        <flux:skeleton class="h-10 w-20" />
                        <flux:skeleton class="h-10 w-20" />
                    </div>
                </div>
            @endplaceholder

            <form wire:submit="save" class="space-y-8">
                <div class="space-y-6">
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <flux:heading size="lg">Edit password</flux:heading>
                        </div>
                        <flux:text>Update your password details below.</flux:text>
                    </div>

                    <flux:input wire:model="name" label="Name" type="text" required />

                    <flux:autocomplete wire:model="username" label="Username" :value="$password->username" required>
                        @foreach ($this->existingUsernames as $existingUsername)
                            <flux:autocomplete.item>
                                {{ $existingUsername }}
                            </flux:autocomplete.item>
                        @endforeach
                    </flux:autocomplete>

                    <flux:input wire:model="newPassword" label="Password" type="password" required viewable copyable>
                        <x-slot name="iconTrailing">
                            <flux:button
                                size="sm"
                                variant="subtle"
                                icon="sparkles"
                                icon:variant="micro"
                                class="-mr-1"
                                square
                                wire:click="generateNewPassword"
                            />
                        </x-slot>
                    </flux:input>

                    <flux:input wire:model="website" label="Website" type="url" placeholder="https://example.com" />

                    <flux:editor
                        wire:model="notes"
                        label="Notes"
                        label:sr-only
                        placeholder="Notes"
                        class="**:data-[slot=content]:min-h-[100px]!"
                    />
                </div>

                <div class="flex flex-col-reverse items-center justify-end gap-3 *:w-full sm:flex-row sm:*:w-auto">
                    <flux:modal.close>
                        <flux:button wire:click="cancelEdit" variant="ghost" class="w-full sm:w-auto">
                            Cancel
                        </flux:button>
                    </flux:modal.close>
                    <flux:button type="submit" variant="primary">Save</flux:button>
                </div>
            </form>
        @endisland
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
