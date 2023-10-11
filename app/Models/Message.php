<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $primaryKey = 'snowflake';

    protected $fillable = [
        'snowflake',
        'content',
        'user_id',
        'channel_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function channel() {
        return $this->belongsTo(Channel::class);
    }

    public function parent() {
        return $this->belongsTo(Message::class);
    }
}
