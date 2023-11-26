<?php

namespace App\Models\_OLD;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProhibitedDomain extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain',
    ];
}
