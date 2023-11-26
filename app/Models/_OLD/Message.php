<?php

namespace App\Models\_OLD;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $primaryKey = 'snowflake';

    public $incrementing = false;

    protected $fillable = [
        'snowflake',
        'content',
        'user_snowflake',
        'channel_snowflake',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function parent()
    {
        return $this->belongsTo(Message::class);
    }
}
