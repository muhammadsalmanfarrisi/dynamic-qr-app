<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortLink extends Model
{
    // Mengizinkan kolom ini untuk diisi data
    protected $fillable = [
        'title',
        'short_code',
        'destination_url',
        'clicks'
    ];
}
