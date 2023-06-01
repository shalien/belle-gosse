<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IgnoredHost extends Model
{
    use HasFactory;

    protected $fillable = ['host', 'url'];

    public function provider_type() {
        return $this->belongsToMany(ProviderType::class);
    }
}
