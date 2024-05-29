<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    protected $fillable = [
        'title',
        'description',
        'date',
        'address',
        'participants',
    ];

    public static function create(mixed $validated)
    {
    }
}

