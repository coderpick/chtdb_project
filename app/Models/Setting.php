<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
    ];

    private static $cachedSettings = null;

    public static function get($key, $default = null)
    {
        if (self::$cachedSettings === null) {
            self::$cachedSettings = self::all()->pluck('value', 'key')->toArray();
        }

        return self::$cachedSettings[$key] ?? $default;
    }
}
