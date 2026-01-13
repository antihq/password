<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;
use Tiptap\Marks\Link;

class Password extends Model
{
    /** @use HasFactory<\Database\Factories\PasswordFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'username',
        'password',
        'website',
        'notes',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    protected function avatarUrl(): Attribute
    {
        return Attribute::get(function (): ?string {
            if (! $this->website) {
                return null;
            }

            $domain = parse_url($this->website, PHP_URL_HOST);

            return $domain ? "https://unavatar.io/{$domain}" : null;
        });
    }

    protected function websiteHostname(): Attribute
    {
        return Attribute::get(function (): ?string {
            return $this->website ? parse_url($this->website, PHP_URL_HOST) : null;
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
            'password' => 'encrypted',
            'notes' => 'encrypted',
        ];
    }
}
