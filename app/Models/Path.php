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

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class);
    }

    public function sources()
    {
        return $this->belongsToMany(Source::class);
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class);
    }
}
