<?php

namespace App\Models\_OLD;

use App\Models\ProviderType;
use App\Models\Supplier;
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

    public function suppliers()
    {
        return $this->hasMany(Supplier::class);
    }
}
