<?php

use App\Models\Password;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    #[Computed]
    public function user()
    {
        return Auth::user();
    }

    #[Computed]
    public function passwords()
    {
        return Password::where('team_id', $this->user->current_team_id)
            ->latest()
            ->get();
    }

    public $name = '';

    public $username = '';

    public $password = '';

    public function create()
    {
        $this->authorize('create', Password::class);

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        $this->user->currentTeam->passwords()->create([
            'name' => $this->pull('name'),
            'username' => $this->pull('username'),
            'password' => $this->pull('password'),
        ]);

        $this->modal('create-password')->close();
    }

    public function delete(Password $password)
    {
        $this->authorize('delete', $password);

        $password->delete();
    }

    public function copyToClipboard(string $text): void
    {
        $this->js("navigator.clipboard.writeText('{$text}')");
    }
};
?>

<section class="mx-auto max-w-6xl space-y-8">
    <div class="flex items-center justify-between">
        <flux:heading size="xl">Passwords</flux:heading>

        @if ($this->passwords->isNotEmpty())
            <flux:modal.trigger name="create-password">
                <flux:button variant="primary">Create Password</flux:button>
            </flux:modal.trigger>
        @endif
    </div>

    @if ($this->passwords->isNotEmpty())
        <ul role="list" class="divide-y divide-white/5 overflow-hidden bg-gray-800/50 outline-1 outline-white/10 sm:rounded-xl sm:-outline-offset-1">
            @foreach ($this->passwords as $password)
                <li wire:key="password-{{ $password->id }}" class="relative flex justify-between gap-x-6 px-4 py-5 hover:bg-white/2.5 sm:px-6">
                    <div class="flex min-w-0 gap-x-4">
                        <div class="size-12 flex-none rounded-full bg-gray-800 outline -outline-offset-1 outline-white/10 flex items-center justify-center">
                            <flux:icon.key variant="outline" class="size-6 text-zinc-500 dark:text-zinc-400" />
                        </div>
                        <div class="min-w-0 flex-auto">
                            <p class="text-sm/6 font-semibold text-white">
                                {{ $password->name }}
                            </p>
                            <p class="mt-1 flex text-xs/5 text-gray-400 truncate">
                                {{ $password->username }}
                            </p>
                        </div>
                    </div>
                    <div class="flex shrink-0 items-center gap-x-4">
                        <div class="hidden sm:flex sm:flex-col sm:items-end gap-2">
                            <div class="flex gap-2">
                                <flux:button
                                    variant="ghost"
                                    size="sm"
                                    wire:click="copyToClipboard('{{ $password->username }}')"
                                >Copy Username</flux:button>
                                <flux:button
                                    variant="ghost"
                                    size="sm"
                                    wire:click="copyToClipboard('{{ $password->password }}')"
                                >Copy Password</flux:button>
                            </div>
                            <div class="flex gap-2">
                                <flux:button
                                    variant="ghost"
                                    size="sm"
                                    href="{{ route('passwords.edit', $password) }}"
                                    wire:navigate
                                >Edit</flux:button>
                                <flux:button
                                    variant="ghost"
                                    size="sm"
                                    wire:confirm="Are you sure you want to delete this password?"
                                    wire:click="delete({{ $password->id }})"
                                >Delete</flux:button>
                            </div>
                        </div>
                        <div class="flex sm:hidden gap-2">
                            <flux:button
                                variant="ghost"
                                size="sm"
                                wire:click="copyToClipboard('{{ $password->username }}')"
                            >Copy Username</flux:button>
                            <flux:button
                                variant="ghost"
                                size="sm"
                                wire:click="copyToClipboard('{{ $password->password }}')"
                            >Copy Password</flux:button>
                            <flux:button
                                variant="ghost"
                                size="sm"
                                href="{{ route('passwords.edit', $password) }}"
                                wire:navigate
                            >Edit</flux:button>
                            <flux:button
                                variant="ghost"
                                size="sm"
                                wire:confirm="Are you sure you want to delete this password?"
                                wire:click="delete({{ $password->id }})"
                            >Delete</flux:button>
                        </div>
                        <flux:icon.chevron-right class="size-5 flex-none text-gray-500 sm:hidden" />
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <div class="text-center">
            <div class="mx-auto flex items-center justify-center">
                <flux:icon.key variant="outline" class="size-6 text-zinc-500 dark:text-zinc-400" />
            </div>
            <flux:heading class="mt-2">No passwords</flux:heading>
            <flux:text class="mt-1">Get started by creating a new password.</flux:text>
            <div class="mt-6">
                <flux:modal.trigger name="create-password">
                    <flux:button variant="primary">Create password</flux:button>
                </flux:modal.trigger>
            </div>
        </div>
    @endif

    <flux:modal name="create-password" class="w-full sm:max-w-lg">
        <form wire:submit="create" class="space-y-8">
            <div class="space-y-6">
                <div class="space-y-2">
                    <flux:heading size="lg">Create password</flux:heading>
                    <flux:text>Create a new password credential to store securely.</flux:text>
                </div>

                <flux:input wire:model="name" label="Name" type="text" required autofocus />

                <flux:input wire:model="username" label="Username" type="text" required />

                <flux:input wire:model="password" label="Password" type="text" required />
            </div>

            <div
                class="flex flex-col-reverse items-center justify-end gap-3 *:w-full sm:flex-row sm:*:w-auto"
            >
                <flux:modal.close>
                    <flux:button variant="ghost" class="w-full sm:w-auto">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">Save</flux:button>
            </div>
        </form>
    </flux:modal>
</section>
