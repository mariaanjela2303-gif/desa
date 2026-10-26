<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'page_url',
        'page_title',
        'ip_address',
        'user_agent',
        'visited_at',
    ];

    public static function logHit(?string $title = null): void
    {
        try {
            static::create([
                'page_url' => request()->fullUrl(),
                'page_title' => $title ?? request()->path(),
                'ip_address' => request()->ip(),
                'user_agent' => substr(request()->userAgent() ?? '', 0, 255),
                'visited_at' => now(),
            ]);
        } catch (\Throwable $e) {
            // Silently continue if analytics logging fails
        }
    }
}
