<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'link',
        'topic_id',
        'prefix'
    ];

    public function topic() {
        return $this->belongsTo(Topic::class);
    }

    public function medias() {
        return $this->hasMany(Media::class);
    }
}
