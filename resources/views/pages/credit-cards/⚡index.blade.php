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

    public $expiry_month = '';

    public $expiry_year = '';

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

        return $query->orderBy('name_on_card')->get();
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
            'name_on_card' => ['required', 'string', 'max:255'],
            'card_number' => ['required', 'string'],
            'expiry_month' => ['required', 'integer', 'between:1,12'],
            'expiry_year' => ['required', 'integer', 'min:'.date('Y')],
            'cvv' => ['required', 'string', 'max:4'],
            'name' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);

        $this->team->creditCards()->create([
            'name_on_card' => $this->pull('name_on_card'),
            'card_number' => $this->pull('card_number'),
            'expiry_month' => $this->pull('expiry_month'),
            'expiry_year' => $this->pull('expiry_year'),
            'cvv' => $this->pull('cvv'),
            'name' => $this->pull('name'),
            'notes' => $this->pull('notes'),
        ]);

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

<section class="mx-auto max-w-3xl space-y-8">
    <div class="flex flex-wrap items-end justify-between gap-4">
        <div class="max-sm:w-full sm:flex-1">
            <flux:heading size="xl">Credit Cards</flux:heading>

            @if ($this->creditCards->isNotEmpty() || $this->search)
                <div class="mt-4 flex max-w-xl gap-4">
                    <flux:input wire:model.live="search" type="search" placeholder="Search" class="flex-1" label:sr-only="Search" icon="magnifying-glass" />
                </div>
            @endif
        </div>

        @if ($this->creditCards->isNotEmpty() || $this->search)
            <flux:modal.trigger name="create-credit-card">
                <flux:button variant="primary">Add credit card</flux:button>
            </flux:modal.trigger>
        @endif
    </div>

    @if ($this->creditCards->isNotEmpty())
        <div class="relative h-full w-full rounded-xl bg-white shadow-[0px_0px_0px_1px_rgba(9,9,11,0.07),0px_2px_2px_0px_rgba(9,9,11,0.05)] dark:bg-zinc-900 dark:shadow-[0px_0px_0px_1px_rgba(255,255,255,0.1)] dark:before:pointer-events-none dark:before:absolute dark:before:-inset-px dark:before:rounded-xl dark:before:shadow-[0px_2px_8px_0px_rgba(0,0,0,0.20),0px_1px_0px_0px_rgba(255,255,255,0.06)_inset] forced-colors:outline">
            <ul role="list" class="overflow-hidden p-[.3125rem]">
                @foreach ($this->creditCards as $creditCard)
                    <livewire:credit-cards.item :$creditCard key="credit-card-{{ $creditCard->id }}" />
                    @unless($loop->last)
                        <li class="mx-3.5 my-1 h-px sm:mx-3">
                            <flux:separator variant="subtle" wire:key="separator-{{ $creditCard->id }}" />
                        </li>
                    @endunless
                @endforeach
            </ul>
        </div>
    @else
        <div class="text-center">
            @if ($this->search)
                <div class="mx-auto flex items-center justify-center">
                    <flux:icon.magnifying-glass variant="outline" class="size-6 text-zinc-500 dark:text-zinc-400" />
                </div>
                <flux:heading class="mt-2">No results found</flux:heading>
                <flux:text class="mt-1">Try adjusting your search term.</flux:text>
            @else
                <div class="mx-auto flex items-center justify-center">
                    <flux:icon.credit-card variant="outline" class="size-6 text-zinc-500 dark:text-zinc-400" />
                </div>
                <flux:heading class="mt-2">No credit cards</flux:heading>
                <flux:text class="mt-1">Get started by adding a new credit card.</flux:text>
                <div class="mt-6">
                    <flux:modal.trigger name="create-credit-card">
                        <flux:button variant="primary">Add credit card</flux:button>
                    </flux:modal.trigger>
                </div>
            @endif
        </div>
    @endif

    <flux:modal name="create-credit-card" class="w-full sm:max-w-lg">
        <form wire:submit="create" class="space-y-8">
            <div class="space-y-6">
                <div class="space-y-2">
                    <flux:heading size="lg">Add credit card</flux:heading>
                    <flux:text>Store a new credit card securely.</flux:text>
                </div>

                <flux:autocomplete wire:model="name_on_card" label="Name on card" required autofocus>
                    @foreach ($this->existingCardholderNames as $existingName)
                        <flux:autocomplete.item>
                            {{ $existingName }}
                        </flux:autocomplete.item>
                    @endforeach
                </flux:autocomplete>

                <flux:input wire:model="card_number" label="Card number" type="password" required viewable copyable />

                <div class="grid gap-4 sm:grid-cols-3">
                    <flux:select wire:model="expiry_month" label="Month" required>
                        @for($i = 1; $i <= 12; $i++)
                            <flux:select.option value="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</flux:select.option>
                        @endfor
                    </flux:select>

                    <flux:select wire:model="expiry_year" label="Year" required>
                        @for($i = date('Y'); $i <= date('Y') + 10; $i++)
                            <flux:select.option value="{{ $i }}">{{ $i }}</flux:select.option>
                        @endfor
                    </flux:select>

                    <flux:input wire:model="cvv" label="CVV" type="password" required viewable />
                </div>

                <flux:input wire:model="name" label="Name" type="text" placeholder="e.g., Personal Visa" />

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
