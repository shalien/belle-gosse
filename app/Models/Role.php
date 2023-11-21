<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $primaryKey = 'snowflake';

    public $incrementing = false;

    protected $fillable = ['snowflake', 'name', 'guild_snowflake'];

    public function guild()
    {
        return $this->belongsTo(Guild::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
