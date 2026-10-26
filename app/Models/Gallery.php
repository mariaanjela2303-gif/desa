<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'file_path',
        'video_url',
        'caption',
    ];

    public function getYoutubeEmbedUrlAttribute(): ?string
    {
        if ($this->type !== 'video' || empty($this->video_url)) {
            return null;
        }

        // Supports formats: youtube.com/watch?v=ID, youtu.be/ID, youtube.com/embed/ID
        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $this->video_url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        return $this->video_url;
    }
}
