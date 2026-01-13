<?php

use App\Models\CreditCard;
use App\Models\Team;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    public CreditCard $creditCard;

    public string $name_on_card = '';

    public string $card_number = '';

    public string $expiry = '';

    public string $cvv = '';

    public string $name = '';

    public string $notes = '';

    public function mount(): void
    {
        $this->resetFormFields();
    }

    private function resetFormFields(): void
    {
        $this->name_on_card = $this->creditCard->name_on_card;
        $this->card_number = $this->creditCard->card_number;
        $this->expiry = sprintf('%02d/%02d', $this->creditCard->expiry_month, substr($this->creditCard->expiry_year, -2));
        $this->cvv = $this->creditCard->cvv;
        $this->name = $this->creditCard->name;
        $this->notes = $this->creditCard->notes ?? '';
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
    public function existingCardholderNames()
    {
        return $this->team
            ->creditCards()
            ->pluck('name_on_card')
            ->unique()
            ->sort()
            ->values();
    }

    #[Computed]
    public function formattedCardNumber(): string
    {
        $number = preg_replace('/\s+/', '', $this->creditCard->card_number);

        if (str_starts_with($number, '34') || str_starts_with($number, '37')) {
            return implode(' ', [
                substr($number, 0, 4),
                substr($number, 4, 6),
                substr($number, 10, 5),
            ]);
        }

        return implode(' ', str_split($number, 4));
    }

    public function save(): void
    {
        $this->authorize('update', $this->creditCard);

        $this->validate([
            'name_on_card' => ['required', 'string', 'max:255'],
            'card_number' => ['required', 'string', 'regex:/^(\d{4}\s?){3}\d{4}$|^(\d{4}\s?\d{6}\s?\d{5})$|^\d{15,16}$/'],
            'expiry' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
            'cvv' => ['required', 'string', 'max:4'],
            'name' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);

        [$month, $shortYear] = explode('/', $this->expiry);
        $year = 2000 + (int) $shortYear;
        $month = (int) $month;
        $currentYear = (int) date('Y');
        $currentMonth = (int) date('m');

        if ($year < $currentYear || ($year === $currentYear && $month < $currentMonth)) {
            $this->addError('expiry', 'The expiry date must be in the future.');

            return;
        }

        $this->creditCard->update([
            'name_on_card' => $this->name_on_card,
            'card_number' => preg_replace('/\s+/', '', $this->card_number),
            'expiry_month' => $month,
            'expiry_year' => $year,
            'cvv' => $this->cvv,
            'name' => $this->name,
            'notes' => $this->notes ?: null,
        ]);

        Flux::modal("edit-credit-card-{$this->creditCard->id}")->close();
    }
};
?>

<li {{ $attributes }}>
    <div
        class="relative flex justify-between gap-x-6 rounded-lg px-3.5 py-2.5 hover:bg-zinc-950/2.5 sm:px-3 sm:py-1.5 dark:hover:bg-white/2.5"
    >
        <div class="flex min-w-0 gap-x-4">
            <div class="shrink-0 max-sm:-mt-0.5">
                <flux:avatar size="xs" class="bg-transparent">
                    <flux:icon.credit-card variant="outline" class="text-zinc-500 dark:text-zinc-400" />
                </flux:avatar>
            </div>
            <div class="min-w-0 flex-auto">
                <flux:heading class="truncate">
                    <flux:modal.trigger name="view-credit-card-{{ $creditCard->id }}">
                        <span class="absolute inset-x-0 -top-px bottom-0"></span>
                        {{ $creditCard->name }}
                    </flux:modal.trigger>
                </flux:heading>
                 <flux:text size="sm">
                    {{ $creditCard->name_on_card }}
                 </flux:text>
            </div>
        </div>
        <div class="flex shrink-0 items-center gap-x-4">
            <flux:dropdown align="end">
                <flux:button icon="ellipsis-horizontal" variant="ghost" square class="-mr-2" />

                <flux:menu>
                    <flux:modal.trigger name="view-credit-card-{{ $creditCard->id }}">
                        <flux:menu.item icon="eye">View</flux:menu.item>
                    </flux:modal.trigger>
                    <flux:modal.trigger name="edit-credit-card-{{ $creditCard->id }}">
                        <flux:menu.item icon="pencil">Edit</flux:menu.item>
                    </flux:modal.trigger>
                    <flux:modal.trigger name="delete-credit-card-{{ $creditCard->id }}">
                        <flux:menu.item variant="danger" icon="trash">Delete</flux:menu.item>
                    </flux:modal.trigger>
                </flux:menu>
            </flux:dropdown>
        </div>
    </div>

    <flux:modal name="view-credit-card-{{ $creditCard->id }}" :closable="false" class="w-full sm:max-w-lg">
        <div class="space-y-8">
            <div class="space-y-6">
                <div class="flex flex-wrap items-center justify-between gap-2">
                    <div class="flex items-center gap-4">
                        <flux:avatar size="md">
                            <flux:icon.credit-card variant="outline" class="text-zinc-500 dark:text-zinc-400" />
                        </flux:avatar>
                        <div>
                            <flux:heading size="lg">{{ $creditCard->name }}</flux:heading>
                            <flux:text size="sm">{{ $creditCard->name_on_card }}</flux:text>
                        </div>
                    </div>
                    <flux:modal.trigger name="edit-credit-card-{{ $creditCard->id }}">
                        <flux:button class="-my-0.5">Edit</flux:button>
                    </flux:modal.trigger>
                </div>

                 <flux:input
                    wire:key="view-card-number"
                    :value="$this->formattedCardNumber"
                    label="Card number"
                    readonly
                    variant="filled"
                    copyable
                 />

                <flux:input
                    wire:key="view-name-on-card"
                    :value="$creditCard->name_on_card"
                    label="Name on card"
                    readonly
                    variant="filled"
                    copyable
                />

                <div class="grid gap-4 sm:grid-cols-2">
                    <flux:input
                        wire:key="view-expiry"
                        :value="sprintf('%02d/%02d', $creditCard->expiry_month, substr($creditCard->expiry_year, -2))"
                        label="Expiry"
                        readonly
                        variant="filled"
                        copyable
                    />

                    <flux:input
                        wire:key="view-cvv"
                        :value="$creditCard->cvv"
                        label="CVV"
                        type="password"
                        readonly
                        variant="filled"
                        copyable
                        viewable
                    />
                </div>

                @if ($creditCard->notes)
                    <flux:accordion>
                        <flux:accordion.item heading="Notes">
                            <x-prose>
                                {!! $creditCard->sanitizedNotes() !!}
                            </x-prose>
                        </flux:accordion.item>
                    </flux:accordion>
                @endif
            </div>
        </div>
    </flux:modal>

    <flux:modal name="edit-credit-card-{{ $creditCard->id }}" class="w-full sm:max-w-lg">
        <form wire:submit="save" class="space-y-8">
            <div class="space-y-6">
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <flux:heading size="lg">Edit credit card</flux:heading>
                    </div>
                    <flux:text>Update your credit card details below.</flux:text>
                </div>

                <flux:autocomplete wire:model="name_on_card" label="Name on card" required>
                    @foreach ($this->existingCardholderNames as $existingName)
                        <flux:autocomplete.item>
                            {{ $existingName }}
                        </flux:autocomplete.item>
                    @endforeach
                </flux:autocomplete>

                <flux:input wire:model="card_number" label="Card number" type="password" required viewable copyable mask:dynamic="$input.startsWith('34') || $input.startsWith('37') ? '9999 999999 99999' : '9999 9999 9999 9999'" />

                <div class="grid gap-4 sm:grid-cols-2">
                    <flux:input wire:model="expiry" mask="99/99" label="Expiry" placeholder="MM/YY" required />

                    <flux:input wire:model="cvv" label="CVV" type="password" required viewable />
                </div>

                <flux:input wire:model="name" label="Name" type="text" placeholder="e.g., Personal Visa" required />

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
                    <flux:button wire:click="cancelEdit" variant="ghost" class="w-full sm:w-auto">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">Save</flux:button>
            </div>
        </form>
    </flux:modal>

    <flux:modal name="delete-credit-card-{{ $creditCard->id }}" class="w-full max-w-xs sm:max-w-md">
        <div class="space-y-6 sm:space-y-4">
            <div>
                <flux:heading>Are you sure you want to delete this credit card?</flux:heading>
                <flux:text class="mt-2">
                    This will permanently delete credit card "{{ $creditCard->name }}". This action
                    cannot be reversed.
                </flux:text>
            </div>
            <div class="flex flex-col-reverse items-center justify-end gap-3 *:w-full sm:flex-row sm:*:w-auto">
                <flux:modal.close>
                    <flux:button variant="ghost" class="w-full sm:w-auto">Cancel</flux:button>
                </flux:modal.close>
                <flux:button wire:click="$parent.delete({{ $creditCard->id }})" variant="primary">Delete</flux:button>
            </div>
        </div>
    </flux:modal>
</li>
