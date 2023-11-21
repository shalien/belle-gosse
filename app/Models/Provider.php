<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        'link',
        'topic_id',
        'prefix',
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function sources()
    {
        return $this->hasMany(Source::class);
    }

    public function provider_link()
    {
        return $this->belongsTo(ProviderLink::class);
    }
}
