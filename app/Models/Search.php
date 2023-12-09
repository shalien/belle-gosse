<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    use HasFactory;
    protected $fillable = ['topic_id', 'path_id', 'supplier_id'];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function path()
    {
        return $this->belongsTo(Path::class);
    }

    public function sources()
    {
        return $this->hasMany(Source::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
