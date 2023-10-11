<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $primaryKey = 'snowflake';

    public $incrementing = false;

    protected $fillable = ['snowflake', 'name'];

    public function guild()
    {
        return $this->belongsTo(Guild::class);
    }
}
