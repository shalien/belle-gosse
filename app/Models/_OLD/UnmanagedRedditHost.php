<?php

namespace App\Models\_OLD;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnmanagedRedditHost extends Model
{
    use HasFactory;

    protected $fillable = [
        'host',
        'url',
    ];
}
