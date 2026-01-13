<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScanHistory extends Model
{
    /** @use HasFactory<\Database\Factories\ScanHistoryFactory> */
    use HasFactory;

    protected $fillable = [
        'content',
        'format',
        'type',
    ];

    public function getIconAttribute(): string
    {
        return match ($this->type) {
            'url' => 'link',
            'email' => 'mail',
            'phone' => 'phone',
            'wifi' => 'wifi',
            'text' => 'document-text',
            default => 'qr-code',
        };
    }

    public static function detectType(string $content): string
    {
        if (filter_var($content, FILTER_VALIDATE_URL)) {
            return 'url';
        }

        if (filter_var($content, FILTER_VALIDATE_EMAIL)) {
            return 'email';
        }

        if (preg_match('/^(\+?[0-9\s\-\(\)]{7,})$/', $content)) {
            return 'phone';
        }

        if (str_starts_with(strtoupper($content), 'WIFI:')) {
            return 'wifi';
        }

        return 'text';
    }
}
