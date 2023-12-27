<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'host',
        'provider_type_id',
    ];

    public function provider_type()
    {
        return $this->belongsTo(ProviderType::class);
    }

    public function searches()
    {
        return $this->hasMany(Search::class);
    }

    public function paths()
    {
        return $this->belongsToMany(Path::class);
    }
}
