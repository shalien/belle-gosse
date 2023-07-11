<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderLink extends Model
{
    use HasFactory;

    protected $fillable = ['link', 'provider_type_id'];

    public function provider_type()
    {
        return $this->belongsTo(ProviderType::class);
    }

    public function providers()
    {
        return $this->hasMany(Provider::class);
    }
}
