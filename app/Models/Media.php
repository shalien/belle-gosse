<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = ['source_id', 'destination_id', 'link'];

    protected $table = 'medias';

    public function source()
    {
        return $this->belongsTo(Source::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
