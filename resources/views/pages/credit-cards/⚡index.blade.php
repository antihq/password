<?php

use App\Models\CreditCard;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Credit Cards')] class extends Component
{
    public $search = '';

    public $name_on_card = '';

    public $card_number = '';

    public $expiry = '';

    public $cvv = '';

    public $name = '';

    public $notes = '';

    #[Computed]
    public function team(): Team
    {
        return Auth::user()->currentTeam;
    }

    #[Computed]
    public function creditCards()
    {
        $query = $this->team->creditCards();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name_on_card', 'like', "%{$this->search}%")
                    ->orWhere('name', 'like', "%{$this->search}%");
            });
        }

        return $query->orderBy('name')->get();
    }

    #[Computed]
    public function existingCardholderNames()
    {
        return $this->team
            ->creditCards()
            ->pluck('name_on_card')
            ->unique()
            ->sort()
            ->values();
    }

    public function create(): void
    {
        $this->authorize('create', CreditCard::class);

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_on_card' => ['required', 'string', 'max:255'],
            'card_number' => [
                'required',
                'string',
                'regex:/^(\d{4}\s?){3}\d{4}$|^\d{4}\s?\d{6}\s?\d{5}$|^\d{15,16}$/',
            ],
            'expiry' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
            'cvv' => ['required', 'string', 'max:4'],
            'notes' => ['nullable', 'string'],
        ]);

        [$month, $shortYear] = explode('/', $this->pull('expiry'));
        $year = 2000 + (int) $shortYear;
        $month = (int) $month;

        if ($year < (int) date('Y') || ($year === (int) date('Y') && $month < (int) date('m'))) {
            $this->addError('expiry', 'The expiry date must be in the future.');

            return;
        }

        $this->team->creditCards()->create([
            'name_on_card' => $this->pull('name_on_card'),
            'card_number' => preg_replace('/\s+/', '', $this->pull('card_number')),
            'expiry_month' => $month,
            'expiry_year' => $year,
            'cvv' => $this->pull('cvv'),
            'name' => $this->pull('name'),
            'notes' => $this->pull('notes'),
        ]);

        $this->renderIsland('credit-cards');

        $this->modal('create-credit-card')->close();
    }

    public function delete($id): void
    {
        $creditCard = $this->team->creditCards()->findOrFail($id);

        $this->authorize('delete', $creditCard);

        $creditCard->delete();
    }
};
?>

<section class="mx-auto max-w-lg">
    <div class="flex flex-wrap items-end justify-between gap-4">
        <div class="max-sm:w-full sm:flex-1">
            <flux:heading size="xl">All credit cards</flux:heading>

            @if ($this->creditCards->isNotEmpty() || $this->search)
                <div class="mt-4 flex max-w-xl gap-4">
                    <flux:input
                        wire:model.live="search"
                        wire:ref="search"
                        type="search"
                        placeholder="Search"
                        class="flex-1"
                        label:sr-only="Search"
                        icon="magnifying-glass"
                        kbd="⌘K"
                    />
                </div>
            @endif
        </div>

        @if ($this->creditCards->isNotEmpty() || $this->search)
            <flux:modal.trigger name="create-credit-card">
                <flux:button variant="primary">Add credit card</flux:button>
            </flux:modal.trigger>
        @endif
    </div>

    <div class="mt-8">
        @if ($this->creditCards->isNotEmpty())
            <hr role="presentation" class="w-full border-t border-zinc-950/10 dark:border-white/10" />
            <div class="divide-y divide-zinc-100 dark:divide-white/5">
                @island(name: 'credit-cards', lazy: true)
                    @placeholder
                        @foreach (range(1, rand(3, 8)) as $i)
                            <flux:skeleton.group animate="shimmer" class="py-4">
                                <flux:skeleton class="h-15" />
                            </flux:skeleton.group>
                        @endforeach
                    @endplaceholder
                    @foreach ($this->creditCards as $creditCard)
                        <livewire:credit-cards.item :$creditCard wire:key="credit-card-{{ $creditCard->id }}" />
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
                    <flux:icon.credit-card variant="outline" size="lg" class="text-gray-400 dark:text-gray-600" />
                    <flux:text class="mt-4 text-gray-500 dark:text-gray-400">No credit cards yet</flux:text>
                    <div class="mt-6">
                        <flux:modal.trigger name="create-credit-card">
                            <flux:button variant="primary">Add credit card</flux:button>
                        </flux:modal.trigger>
                    </div>
                @endif
            </div>
        @endif
    </div>

    <flux:modal name="create-credit-card" class="w-full sm:max-w-lg">
        <form wire:submit="create" class="space-y-8">
            <div class="space-y-6">
                <div class="space-y-2">
                    <flux:heading size="lg">Add credit card</flux:heading>
                    <flux:text>Store a new credit card securely.</flux:text>
                </div>

                <flux:input
                    wire:model="name"
                    label="Name"
                    type="text"
                    placeholder="e.g., Personal Visa"
                    required
                    autofocus
                />

                <flux:autocomplete wire:model="name_on_card" label="Name on card" required>
                    @foreach ($this->existingCardholderNames as $existingName)
                        <flux:autocomplete.item>
                            {{ $existingName }}
                        </flux:autocomplete.item>
                    @endforeach
                </flux:autocomplete>

                <flux:input
                    wire:model="card_number"
                    label="Card number"
                    required
                    mask:dynamic="$input.startsWith('34') || $input.startsWith('37') ? '9999 999999 99999' : '9999 9999 9999 9999'"
                />

                <div class="grid grid-cols-2 gap-4">
                    <flux:input wire:model="expiry" mask="99/99" label="Expiry" placeholder="MM/YY" required />

                    <flux:input wire:model="cvv" label="CVV" type="password" required viewable />
                </div>

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
