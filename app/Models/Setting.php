<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    public static function get($key, $default = null)
    {
        return cache()->rememberForever(
            "setting_{$key}",
            fn () =>
                static::where('key', $key)
                    ->value('value')
                    ?? $default
        );
    }

    public static function set($key, $value)
    {
        cache()->forget("setting_{$key}");

        return static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}