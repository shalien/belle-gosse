<?php

namespace App\Models\_OLD;

use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicAlias extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic_id',
        'alias',
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
