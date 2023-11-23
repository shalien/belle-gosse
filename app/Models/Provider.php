<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        'host',
        'provider_type_id',
    ];

    public function queries()
    {
        return $this->hasMany(Query::class);
    }

    public function provider_type()
    {
        return $this->belongsTo(ProviderType::class);
    }
}
