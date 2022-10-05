<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'source',
        'media',
        'destination',
        'provider_id'
    ];


    public function provider() {
        return $this->belongsTo(Provider::class);
    }
}
