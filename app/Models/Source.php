<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;

    protected $fillable = ['link', 'provider_id'];

    public function provider()
    {
        return $this->belongsTo(OldProvider::class);
    }

    public function medias()
    {
        return $this->hasMany(Media::class);
    }
}
