<?php

use App\Models\Password;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    public $name = '';

    public $username = '';

    public $password = '';

    #[Computed]
    public function user()
    {
        return Auth::user();
    }

    public function create()
    {
        $this->authorize('create', Password::class);

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        $this->user->currentTeam->passwords()->create([
            'name' => $this->name,
            'username' => $this->username,
            'password' => $this->password,
        ]);

        return $this->redirectRoute('passwords.index');
    }
};
?>

<section class="mx-auto max-w-6xl space-y-8">
    <flux:heading size="xl">Create password</flux:heading>

    <div class="space-y-14">
        <div class="space-y-6">
            <header class="space-y-1">
                <flux:heading size="lg">Password details</flux:heading>
                <flux:text>Create a new password credential to store securely.</flux:text>
            </header>

            <form wire:submit="create" class="w-full max-w-lg space-y-8">
                <flux:input wire:model="name" label="Name" type="text" required autofocus />

                <flux:input wire:model="username" label="Username" type="text" required />

                <flux:input wire:model="password" label="Password" type="text" required />

                <div class="flex items-center gap-4">
                    <div class="flex items-center justify-end">
                        <flux:button variant="primary" type="submit" class="w-full">Create password</flux:button>
                    </div>
                    <div class="flex items-center justify-end">
                        <flux:button href="{{ route('passwords.index') }}" wire:navigate variant="ghost">
                            Cancel
                        </flux:button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
