<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Path extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
    ];

    public function searches()
    {
        return $this->hasMany(Search::class);
    }
}
