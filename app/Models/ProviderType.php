<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function provider_links()
    {
        return $this->hasMany(ProviderLink::class);
    }

    public function providers()
    {
        return $this->hasMany(Provider::class);
    }

    public function ignored_hosts()
    {
        return $this->belongsToMany(IgnoredHost::class);
    }
}
