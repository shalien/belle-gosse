<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guild extends Model
{
    use HasFactory;

    protected $primaryKey = 'snowflake';

    public $incrementing = false;


    protected $fillable = [
        'snowflake',
        'name',
        'icon'
    ];

    public function channels()
    {
        return $this->hasMany(Channel::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'guild_user', 'user_snowflake', 'guild_snowflake', 'snowflake', 'snowflake');
    }
}
