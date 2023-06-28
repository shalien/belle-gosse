<?php

namespace App\Models;

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

    public function aliases()
    {
        return $this->hasMany(TopicAlias::class);
    }
}
