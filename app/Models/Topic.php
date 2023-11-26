<?php

namespace App\Models;

use App\Models\_OLD\Provider;
use App\Models\_OLD\TopicAlias;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'order',
    ];

    public function providers()
    {
        return $this->hasMany(Provider::class);
    }

    public function topic_aliases()
    {
        return $this->hasMany(TopicAlias::class);
    }

    public function paths()
    {
        return $this->belongsToMany(Path::class);
    }
}
