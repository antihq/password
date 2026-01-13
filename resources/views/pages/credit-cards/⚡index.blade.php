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

                <flux:input wire:model="name" label="Name" type="text" placeholder="e.g., Personal Visa" required autofocus />

                <flux:autocomplete wire:model="name_on_card" label="Name on card" required>
                    @foreach ($this->existingCardholderNames as $existingName)
                        <flux:autocomplete.item>
                            {{ $existingName }}
                        </flux:autocomplete.item>
                    @endforeach
                </flux:autocomplete>

                <flux:input wire:model="card_number" label="Card number" required mask:dynamic="$input.startsWith('34') || $input.startsWith('37') ? '9999 999999 99999' : '9999 9999 9999 9999'" />

                <div class="grid grid-cols-2 gap-4">
                    <flux:input wire:model="expiry" mask="99/99" label="Expiry" placeholder="MM/YY" required />

                    <flux:input wire:model="cvv" label="CVV" type="password" required viewable />
                </div>

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
