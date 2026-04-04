<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'slug',
        'theme',
        'is_visible',
        'tagline',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
