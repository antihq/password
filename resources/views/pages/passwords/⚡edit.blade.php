<?php

use App\Models\Password;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    public Password $password;

    public $name = '';

    public $username = '';

    public $passwordInput = '';

    public function mount(Password $password)
    {
        $this->authorize('update', $password);

        $this->password = $password;
        $this->name = $password->name;
        $this->username = $password->username;
        $this->passwordInput = $password->password;
    }

    #[Computed]
    public function user()
    {
        return Auth::user();
    }

    public function update()
    {
        $this->authorize('update', $this->password);

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'passwordInput' => ['required', 'string'],
        ]);

        $this->password->update([
            'name' => $this->name,
            'username' => $this->username,
            'password' => $this->passwordInput,
        ]);

        return $this->redirectRoute('passwords.index');
    }
};
?>

<section class="mx-auto max-w-6xl space-y-8">
    <flux:heading size="xl">Edit password</flux:heading>

    <div class="space-y-14">
        <div class="space-y-6">
            <header class="space-y-1">
                <flux:heading size="lg">Password details</flux:heading>
                <flux:text>Update password credential information.</flux:text>
            </header>

            <form wire:submit="update" class="w-full max-w-lg space-y-8">
                <flux:input wire:model="name" label="Name" type="text" required autofocus />

                <flux:input wire:model="username" label="Username" type="text" required />

                <flux:input wire:model="passwordInput" label="Password" type="text" required />

                <div class="flex items-center gap-4">
                    <div class="flex items-center justify-end">
                        <flux:button variant="primary" type="submit" class="w-full">Update password</flux:button>
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
