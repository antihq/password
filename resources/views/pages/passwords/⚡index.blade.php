<?php

use App\Models\Password;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Passwords')] class extends Component
{
    public $name = '';

    public $username = '';

    public $password = '';

    public $website = '';

    public $notes = '';

    public function mount()
    {
        $this->generatePassword();
    }

    #[Computed]
    public function team(): Team
    {
        return Auth::user()->currentTeam;
    }

    #[Computed]
    public function passwords()
    {
        return $this->team
            ->passwords()
            ->latest()
            ->get();
    }

    public function generatePassword(): void
    {
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $alphanumeric = 'abcdefghijklmnopqrstuvwxyz0123456789';

        $part1 = substr(str_shuffle(str_repeat($lowercase, 3)), 0, 6);
        $part2 = substr(str_shuffle(str_repeat($alphanumeric, 3)), 0, 6);
        $part3 = ucfirst(substr(str_shuffle(str_repeat($lowercase, 3)), 0, 6));

        $this->password = sprintf('%s-%s-%s', $part1, $part2, $part3);
    }

    public function create()
    {
        $this->authorize('create', Password::class);

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
            'website' => ['nullable', 'url', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);

        $this->team->passwords()->create([
            'name' => $this->pull('name'),
            'username' => $this->pull('username'),
            'password' => $this->pull('password'),
            'website' => $this->pull('website'),
            'notes' => $this->pull('notes'),
        ]);

        $this->modal('create-password')->close();
    }

    public function delete($id)
    {
        $password = $this->team()->passwords()->findOrFail($id);

        $this->authorize('delete', $password);

        $password->delete();
    }
};
?>

<section class="mx-auto max-w-3xl space-y-8">
    <div class="flex items-center justify-between">
        <flux:heading size="xl">Passwords</flux:heading>

        @if ($this->passwords->isNotEmpty())
            <flux:modal.trigger name="create-password">
                <flux:button variant="primary" class="-my-0.5">Add password</flux:button>
            </flux:modal.trigger>
        @endif
    </div>

    @if ($this->passwords->isNotEmpty())
        <div class="relative h-full w-full rounded-xl bg-white shadow-[0px_0px_0px_1px_rgba(9,9,11,0.07),0px_2px_2px_0px_rgba(9,9,11,0.05)] dark:bg-zinc-900 dark:shadow-[0px_0px_0px_1px_rgba(255,255,255,0.1)] dark:before:pointer-events-none dark:before:absolute dark:before:-inset-px dark:before:rounded-xl dark:before:shadow-[0px_2px_8px_0px_rgba(0,0,0,0.20),0px_1px_0px_0px_rgba(255,255,255,0.06)_inset] forced-colors:outline">
            <ul role="list" class="overflow-hidden p-[.3125rem]">
                @foreach ($this->passwords as $password)
                    <livewire:passwords.item :$password key="password-{{ $password->id }}" />
                    @unless($loop->last)
                        <li class="mx-3.5 my-1 h-px sm:mx-3">
                            <flux:separator variant="subtle" />
                        </li>
                    @endunless
                @endforeach
            </ul>
        </div>
    @else
        <div class="text-center">
            <div class="mx-auto flex items-center justify-center">
                <flux:icon.key variant="outline" class="size-6 text-zinc-500 dark:text-zinc-400" />
            </div>
            <flux:heading class="mt-2">No passwords</flux:heading>
            <flux:text class="mt-1">Get started by adding a new password.</flux:text>
            <div class="mt-6">
                <flux:modal.trigger name="create-password">
                    <flux:button variant="primary">Add password</flux:button>
                </flux:modal.trigger>
            </div>
        </div>
    @endif

    <flux:modal name="create-password" class="w-full sm:max-w-lg">
        <form wire:submit="create" class="space-y-8">
            <div class="space-y-6">
                <div class="space-y-2">
                    <flux:heading size="lg">Add password</flux:heading>
                    <flux:text>Store a new password credential securely.</flux:text>
                </div>

                <flux:input wire:model="name" label="Name" type="text" required autofocus />

                <flux:input wire:model="username" label="Username" type="text" required />

                <flux:input wire:model="password" label="Password" type="password" required viewable copyable>
                    <x-slot name="iconTrailing">
                        <flux:button size="sm" variant="subtle" icon="sparkles" icon:variant="micro" class="-mr-1" square wire:click="generatePassword" />
                    </x-slot>
                </flux:input>

                <flux:input wire:model="website" label="Website" type="url" placeholder="https://example.com" />

                <flux:editor wire:model="notes" label="Notes" label:sr-only placeholder="Notes" />
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
