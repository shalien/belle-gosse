<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class);
    }
}
