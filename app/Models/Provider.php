<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;


    public function topic() {
        return $this->hasOne(Topic::class);
    }

    public function medias() {
        return $this->hasMany(Media::class);
    }
}
