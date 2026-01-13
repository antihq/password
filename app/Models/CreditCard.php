<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;
use Tiptap\Marks\Link;

class CreditCard extends Model
{
    /** @use HasFactory<\Database\Factories\CreditCardFactory> */
    use HasFactory;

    protected $fillable = [
        'name_on_card',
        'card_number',
        'expiry_month',
        'expiry_year',
        'cvv',
        'name',
        'notes',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    protected function maskedNumber(): Attribute
    {
        return Attribute::get(function (): string {
            $lastFour = substr($this->card_number, -4);

            return '•••• •••• •••• '.$lastFour;
        });
    }

    protected function formattedExpiry(): Attribute
    {
        return Attribute::get(function (): string {
            return sprintf('%02d/%d', $this->expiry_month, $this->expiry_year);
        });
    }

    protected function lastFour(): Attribute
    {
        return Attribute::get(function (): string {
            return substr($this->card_number, -4);
        });
    }

    public function sanitizedNotes(): ?string
    {
        return $this->notes
            ? (new Editor(['extensions' => [new StarterKit, new Link]]))->sanitize($this->notes)
            : null;
    }

    protected function casts(): array
    {
        return [
            'card_number' => 'encrypted',
            'cvv' => 'encrypted',
            'notes' => 'encrypted',
        ];
    }
}
