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
        'provider_type_id',
    ];

    public function provider_type()
    {
        return $this->belongsTo(ProviderType::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function sources()
    {
        return $this->hasMany(Source::class);
    }
}
