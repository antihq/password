<?php

use App\Models\Password;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Passwords')] class extends Component
{
    public $search = '';

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
        $query = $this->team->passwords();

        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%");
        }

        return $query->orderBy('name')->get();
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

    public function generatePassword(): void
    {
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $alphanumeric = $lowercase.'0123456789';

        $part1 = substr(str_shuffle(str_repeat($lowercase, 3)), 0, 6);
        $part2 = substr(str_shuffle(str_repeat($alphanumeric, 3)), 0, 6);
        $part3 = ucfirst(substr(str_shuffle(str_repeat($lowercase, 3)), 0, 6));

        $this->password = "{$part1}-{$part2}-{$part3}";
    }

    public function create(): void
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

        $this->renderIsland('passwords');

        $this->generatePassword();

        $this->modal('create-password')->close();
    }

    public function delete($id)
    {
        $password = $this->team->passwords()->findOrFail($id);

        $this->authorize('delete', $password);

        $password->delete();
    }
};
?>

<section class="mx-auto max-w-lg">
    <div class="flex flex-wrap items-end justify-between gap-4">
        <div class="max-sm:w-full sm:flex-1">
            <flux:heading size="xl">All passwords</flux:heading>

            @if ($this->passwords->isNotEmpty() || $this->search)
                <div class="mt-4 flex max-w-xl gap-4">
                    <flux:input wire:model.live="search" wire:ref="search" type="search" placeholder="Search" class="flex-1" label:sr-only="Search" icon="magnifying-glass" kbd="⌘K" />
                </div>
            @endif
        </div>

        @if ($this->passwords->isNotEmpty() || $this->search)
            <flux:modal.trigger name="create-password">
                <flux:button variant="primary">Add password</flux:button>
            </flux:modal.trigger>
        @endif
    </div>

    <div class="mt-8">
        @if ($this->passwords->isNotEmpty())
            <hr role="presentation" class="w-full border-t border-zinc-950/10 dark:border-white/10" />
            <div class="divide-y divide-zinc-100 dark:divide-white/5">
                @island(name: 'passwords', lazy: true)
                    @placeholder
                        @foreach (range(1, rand(3, 8)) as $i)
                            <flux:skeleton.group animate="shimmer" class="py-4">
                                <flux:skeleton class="h-15" />
                            </flux:skeleton.group>
                        @endforeach
                    @endplaceholder
                    @foreach ($this->passwords as $password)
                        <livewire:passwords.item :$password wire:key="password-{{ $password->id }}" />
                    @endforeach
                @endisland
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-12">
                @if ($this->search)
                    <flux:icon.magnifying-glass variant="outline" size="lg" class="text-gray-400 dark:text-gray-600" />
                    <flux:text class="mt-4 text-gray-500 dark:text-gray-400">No results found</flux:text>
                    <flux:text class="mt-1 text-gray-500 dark:text-gray-400">Try adjusting your search term.</flux:text>
                @else
                    <flux:icon.key variant="outline" size="lg" class="text-gray-400 dark:text-gray-600" />
                    <flux:text class="mt-4 text-gray-500 dark:text-gray-400">No passwords yet</flux:text>
                    <div class="mt-6">
                        <flux:modal.trigger name="create-password">
                            <flux:button variant="primary">Add password</flux:button>
                        </flux:modal.trigger>
                    </div>
                @endif
            </div>
        @endif
    </div>

    <flux:modal name="create-password" class="w-full sm:max-w-lg">
        <form wire:submit="create" class="space-y-8">
            <div class="space-y-6">
                <div class="space-y-2">
                    <flux:heading size="lg">Add password</flux:heading>
                    <flux:text>Store a new password credential securely.</flux:text>
                </div>

                <flux:input wire:model="name" label="Name" type="text" required autofocus />

                <flux:autocomplete wire:model="username" label="Username" required>
                    @foreach ($this->existingUsernames as $existingUsername)
                        <flux:autocomplete.item>
                            {{ $existingUsername }}
                        </flux:autocomplete.item>
                    @endforeach
                </flux:autocomplete>

                <flux:input wire:model="password" label="Password" type="password" required viewable copyable>
                    <x-slot name="iconTrailing">
                        <flux:button size="sm" variant="subtle" icon="sparkles" icon:variant="micro" class="-mr-1" square wire:click="generatePassword" />
                    </x-slot>
                </flux:input>

                <flux:input wire:model="website" label="Website" type="url" placeholder="https://example.com" />

                <flux:editor wire:model="notes" label="Notes" label:sr-only placeholder="Notes" class="**:data-[slot=content]:min-h-[100px]!" />
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

<script>
    document.addEventListener('keydown', (e) => {
        if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
            e.preventDefault();
            this.$refs.search.focus()
        }
    });
</script>
