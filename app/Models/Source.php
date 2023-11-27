<?php

namespace App\Models;

use App\Models\_OLD\Provider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;

    protected $fillable = ['link', 'path_id'];

   // deprecated
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }


    public function path()
    {
        return $this->belongsTo(Path::class);
    }

    public function medias()
    {
        return $this->hasMany(Media::class);
    }
}
