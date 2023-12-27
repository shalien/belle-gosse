<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;

    protected $fillable = ['link', 'path_id'];

    public function medias()
    {
        return $this->hasMany(Media::class);
    }

    public function search()
    {
        return $this->belongsTo(Search::class);
    }
}
