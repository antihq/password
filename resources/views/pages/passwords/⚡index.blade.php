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
            <flux:button variant="primary" href="{{ route('passwords.create') }}" wire:navigate>
                Create Password
            </flux:button>
        @endif
    </div>

    @if ($this->passwords->isNotEmpty())
        <div class="overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
                <thead class="bg-neutral-50 dark:bg-neutral-800/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-neutral-900 dark:text-white">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-neutral-900 dark:text-white">Username</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-neutral-900 dark:text-white">Password</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-neutral-900 dark:text-white">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700 bg-white dark:bg-neutral-900">
                    @foreach ($this->passwords as $password)
                        <tr wire:key="password-{{ $password->id }}">
                            <td class="px-6 py-4">
                                <flux:text>{{ $password->name }}</flux:text>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <flux:text>{{ $password->username }}</flux:text>
                                    <flux:button
                                        variant="ghost"
                                        size="sm"
                                        wire:click="copyToClipboard('{{ $password->username }}')"
                                    >Copy</flux:button>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <flux:text class="font-mono">•••••••</flux:text>
                                    <flux:button
                                        variant="ghost"
                                        size="sm"
                                        wire:click="copyToClipboard('{{ $password->password }}')"
                                    >Copy</flux:button>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center">
            <div class="mx-auto flex items-center justify-center">
                <flux:icon.key variant="outline" class="size-6 text-zinc-500 dark:text-zinc-400" />
            </div>
            <flux:heading class="mt-2">No passwords</flux:heading>
            <flux:text class="mt-1">Get started by creating a new password.</flux:text>
            <div class="mt-6">
                <flux:button variant="primary" href="{{ route('passwords.create') }}" wire:navigate>
                    Create password
                </flux:button>
            </div>
        </div>
    @endif
</section>
