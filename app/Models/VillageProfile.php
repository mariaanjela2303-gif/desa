<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillageProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'village_name',
        'district',
        'regency',
        'province',
        'about',
        'history',
        'vision',
        'mission',
        'leader_name',
        'welcome_message',
        'leader_photo',
    ];
}
